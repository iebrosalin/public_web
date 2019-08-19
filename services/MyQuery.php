<?php
namespace Services;

use Exception;

class MyQuery{
    private $connection;

    public function __construct()
    {

        $host=getenv('DB_HOST');
        $port=getenv('PORT_PG');
        $dbname=getenv('POSTGRES_DB');
        $db_user=getenv('POSTGRES_USER');
        $db_user_pass=getenv('POSTGRES_PASSWORD');
        $settings=<<<SETTINGS
host=$host port=$port user=$db_user password=$db_user_pass dbname=$dbname
SETTINGS;

        $this->connection= pg_connect($settings);
        if($this->connection===false){
            throw new Exception(pg_last_error());
        }
    }

    public static function getCreateTableQuery(){
        return [
            'CREATE TABLE if not exists courses(
            c_no text PRIMARY KEY,
            title text,
            hours integer 
        )',
            'CREATE TABLE if not exists  students(
            s_id integer PRIMARY KEY,
            name text,
            start_year integer
        )',
            'CREATE TABLE if not exists  exams(
            s_id integer REFERENCES students(s_id),
            c_no text REFERENCES courses(c_no),
            score integer,
            CONSTRAINT pk PRIMARY KEY (s_id,c_no)
        )',
            'CREATE TABLE if not exists  course_chapters(
            c_no text REFERENCES courses(c_no),
            ch_no text,
            ch_title text,
            txt text,
            CONSTRAINT pkt_ch PRIMARY KEY (ch_no,c_no)
        )',
            'CREATE TABLE IF NOT EXISTS groups(g_no text PRIMARY KEY, monitor integer NOT NULL REFERENCES students(s_id));',
            'ALTER TABLE students ADD g_no text REFERENCES groups(g_no);',
            'create table student_details(
                    de_id int,
                    s_id int references students(s_id), 
                    details json,
                    CONSTRAINT pk_d primary key (s_id,de_id))',

        ];
    }
    public static function getFillTableQuery(){
        return [
            "begin",
            "INSERT INTO  courses(c_no, title, hours)
            VALUES ('CS301', 'Базы данных', 30),
                   ('CS305', 'Сети ЭВМ', 60)",
            "INSERT INTO  students(s_id, name, start_year)
            VALUES (1451, 'Анна', 2014),
                   (1432, 'Виктор', 2014),
                   (1556, 'Нина', 2015)",
            "INSERT INTO  exams(s_id, c_no, score)
            VALUES (1451, 'CS301', 5),
                   (1556, 'CS301', 5),
                   (1451, 'CS305', 5),
                   (1432, 'CS305', 4)
                   ",
            "INSERT INTO  course_chapters(c_no, ch_no,ch_title,txt)
            VALUES ('CS301', 'I','Базы данных', 'С этой главы начинается наше знакомство с увлекательным миром баз данных'),
                   ('CS301', 'II','Первые шаги', 'Продолжаем знакомство с миром баз данных.Создадим нашу первую текстовуюбазу данных'),
                   ('CS305', 'I','Локальные сети', 'Здесь начнётся наше полное приключений путешествие в интригующий мир сетей')
                   ",
            <<<QUERY
            INSERT INTO  student_details(de_id, s_id,details)
            VALUES (1, 1451,'{
                            "достоинства":"отсутствуют", 
                            "недостатки":"неумеренное употребление мороженного"
                            }'),
                   (2, 1432,'{
                            "хобби":{
                            "гитарист":{
                            "группа":"Постгрессоры",
                              "гитары": ["страт","телек"]
                                } 
                            }
                            }'),
                    (3,1556,'{
                            "хобби":"косплей",
                            "достоинства":{
                                    "мать-героиня":{
                                        "Вася":"м","Семён":"м","Люся":"ж","Макар":"м","Саша":"сведения отсутствуют"
                                    }
                                }
                           }'),
                           (4, 1451, '{
                                     "статус":"отчислена"
                                     }')
QUERY,
            "commit"

        ];
    }
    public static function initDb(MyQuery $db)
    {
//        if(is_array($db->execFetch(' * from courses limit 1'))) {
            $db->create_tables(self::getCreateTableQuery());
            $db->filling_tables(self::getFillTableQuery());
//        }
    }
    private function exec(string $query)
    {
        $resQuery=pg_query($this->connection,$query);
        $this->checkFail($query);
        return $resQuery;
    }

    public function execFetch(string $query)
    {
        return $this->fetch($this->exec($query));
    }
    public function create_tables($query)
    {
        $arQuery=$query;

        foreach ($arQuery as $v)
        {
            $this->exec($v);
        }
    }

    public function filling_tables($query)
    {
        $arQuery=$query;
    foreach ($arQuery as $v)
    {
        $this->exec($v);
    }

    }

    public function  get_all_tables(){
        $res=[];
        $queryCourse = $this->exec("SELECT * FROM courses");
        while($row=pg_fetch_assoc($queryCourse)){
            $res['course'][]=$row;
        }
        $queryStudent = $this->exec("SELECT * FROM students");
        while($row=pg_fetch_assoc($queryStudent)){
            $res['student'][]=$row;
        }
        $queryExam = $this->exec("SELECT * FROM exams");
        while($row=pg_fetch_assoc($queryExam)){
            $res['exam'][]=$row;
        }
        $queryExam = $this->exec("SELECT * FROM course_chapters");
        while($row=pg_fetch_assoc($queryExam)){
            $res['course_chapters'][]=$row;
        }
        $queryExam = $this->exec("SELECT * FROM student_details");
        while($row=pg_fetch_assoc($queryExam)){
            $res['student_details'][]=$row;
        }
        return $res;
    }

    public function example_delete(){
        $query=pg_query($this->connection,"DELETE FROM courses WHERE score < 5");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_transaction(){
        $query=pg_query($this->connection,
            "BEGIN;"
        );
        $query=pg_query($this->connection,
            "INSERT INTO groups(g_no,monitor) SELECT 'A-101', s_id FROM students WHERE name='Анна';"
        );

        $query=pg_query($this->connection,
            "UPDATE students SET g_no='A-101';"
        );

        $query=pg_query($this->connection,
            "COMMIT;"
        );
    }
    public function example_get_students(){
        $query=pg_query($this->connection,"select * from students");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_get_groups(){
        $query=pg_query($this->connection,"select * from groups");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_get_course_chapters(){
        $query=pg_query($this->connection,"select * from course_chapters");
        $this->checkFail($query);
        return $this->fetch($query);
    }

    public function example_create_fullsearch(){
        $query=pg_query($this->connection,"alter table course_chapters add txtvector tsvector");
        $query=pg_query($this->connection,"update course_chapters set txtvector=to_tsvector('russian',txt)");
        $query=pg_query($this->connection,"select * from course_chapters ");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_create_fullsearch_2(){
        $query=pg_query($this->connection,"update course_chapters set txtvector=setweight(to_tsvector('russian',ch_title),'B') || ''
            || setweight(to_tsvector('russian',txt),'D')");
        $query=pg_query($this->connection,"select * from course_chapters ");
        $this->checkFail($query);
        return $this->fetch($query);
    }

    public function example_jsonb_create(){
        $query=pg_query($this->connection,"alter table student_details add details_b jsonb");
        $query=pg_query($this->connection,"update student_details set details_b=to_jsonb(details)");
        $query=pg_query($this->connection,"select * from student_details");
        $this->checkFail($query);
        return $this->fetch($query);
    }


    public function fetch($query){
        $res=[];
        while($row=pg_fetch_assoc($query)){
            $res[]=$row;
        }
        return $res;
    }

    private function checkFail($query){
        if($query===false){
            throw new Exception(pg_last_error());
        }
    }

    public function clear_all()
    {
        $this->execFetch('begin');
        $this->execFetch('DROP table course_chapters, courses, exams,groups, student_details, students');
        $this->execFetch('commit');
    }
}
