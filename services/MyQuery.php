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
    public function create_tables()
    {
        $arQuery=
            [
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
//        $query = pg_query($this->connection,'CREATE TABLE if not exists courses(
//            c_no text PRIMARY KEY,
//            title text,
//            hours integer
//        )');
//        $this->checkFail($query);
//        $query = pg_query($this->connection,'CREATE TABLE if not exists  students(
//            s_id integer PRIMARY KEY,
//            name text,
//            start_year integer
//        )');
//        $this->checkFail($query);
//
//        $query = pg_query($this->connection,'CREATE TABLE if not exists  exams(
//            s_id integer REFERENCES students(s_id),
//            c_no text REFERENCES courses(c_no),
//            score integer,
//            CONSTRAINT pk PRIMARY KEY (s_id,c_no)
//        )');
//        $this->checkFail($query);

//        $query = pg_query($this->connection,'CREATE TABLE if not exists  course_chapters(
//            c_no text REFERENCES courses(c_no),
//            ch_no text,
//            ch_title text,
//            txt text,
//            CONSTRAINT pkt_ch PRIMARY KEY (ch_no,c_no)
//        )');
//        $query = pg_query($this->connection,'CREATE TABLE IF NOT EXISTS groups(g_no text PRIMARY KEY, monitor integer NOT NULL REFERENCES students(s_id));');
//        $this->checkFail($query);
//
//        $query = pg_query($this->connection,'ALTER TABLE students ADD g_no text REFERENCES groups(g_no);');
//
//        $this->checkFail($query);

//        $query = pg_query($this->connection,'create table student_details(
//                    de_id int,
//                    s_id int references students(s_id),
//                    details json,
//                    CONSTRAINT pk_d primary key (s_id,de_id))');
//
//        $this->checkFail($query);

        foreach ($arQuery as $v)
        {
            $this->exec($v);
        }
    }

    public function filling_tables()
    {
        $arQuery=
            [
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
//        pg_query($this->connection,"begin");
//        $query = pg_query($this->connection,"INSERT INTO  courses(c_no, title, hours)
//            VALUES ('CS301', 'Базы данных', 30),
//                   ('CS305', 'Сети ЭВМ', 60)");
//        $this->checkFail($query);
//        $query= pg_query($this->connection,"INSERT INTO  students(s_id, name, start_year)
//            VALUES (1451, 'Анна', 2014),
//                   (1432, 'Виктор', 2014),
//                   (1556, 'Нина', 2015)");
//        $this->checkFail($query);
//        $query = pg_query($this->connection,"INSERT INTO  exams(s_id, c_no, score)
//            VALUES (1451, 'CS301', 5),
//                   (1556, 'CS301', 5),
//                   (1451, 'CS305', 5),
//                   (1432, 'CS305', 4)
//                   ");

//
//        $this->checkFail($query);
//        $query = pg_query($this->connection,"INSERT INTO  course_chapters(c_no, ch_no,ch_title,txt)
//            VALUES ('CS301', 'I','Базы данных', 'С этой главы начинается наше знакомство с увлекательным миром баз данных'),
//                   ('CS301', 'II','Первые шаги', 'Продолжаем знакомство с миром баз данных.Создадим нашу первую текстовуюбазу данных'),
//                   ('CS305', 'I','Локальные сети', 'Здесь начнётся наше полное приключений путешествие в интригующий мир сетей')
//                   ");
//        $this->checkFail($query);
//        $query = pg_query($this->connection,<<<QUERY
//            INSERT INTO  student_details(de_id, s_id,details)
//            VALUES (1, 1451,'{
//                            "достоинства":"отсутствуют",
//                            "недостатки":"неумеренное употребление мороженного"
//                            }'),
//                   (2, 1432,'{
//                            "хобби":{
//                            "гитарист":{
//                            "группа":"Постгрессоры",
//                              "гитары": ["страт","телек"]
//                                }
//                            }
//                            }'),
//                    (3,1556,'{
//                            "хобби":"косплей",
//                            "достоинства":{
//                                    "мать-героиня":{
//                                        "Вася":"м","Семён":"м","Люся":"ж","Макар":"м","Саша":"сведения отсутствуют"
//                                    }
//                                }
//                           }'),
//                           (4, 1451, '{
//                                     "статус":"отчислена"
//                                     }')
//QUERY
//
//                   );
//        $this->checkFail($query);
//        pg_query($this->connection,"commit");
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
    public function example_select_as(){
        $query=$this->exec('SELECT title AS course_title, hours FROM courses');
        return $this->fetch($query);
    }
    public function example_select_all_course(){
        $query=$this->exec('SELECT * FROM courses');
        return $this->fetch($query);
    }
    public function example_select_repeat_column(){
        $query=$this->exec('SELECT start_year FROM students');
        return $this->fetch($query);
    }
    public function example_select_without_repeat_column(){
        $query=$this->exec('SELECT DISTINCT start_year FROM students');
        return $this->fetch($query);
    }
    public function example_select_math(){
        $query=$this->exec('SELECT 2+52 AS result');
        return $this->fetch($query);
    }
    public function example_select_where(){
        $query=$this->exec('SELECT * FROM courses WHERE hours>45');
        return $this->fetch($query);
    }
    public function example_select_many_tables(){
        $query=pg_query($this->connection,'SELECT * FROM courses, exams');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_many_tables_with_where(){
        $query=pg_query($this->connection,'SELECT courses.title, exams.s_id, exams.score FROM courses, exams WHERE courses.c_no=exams.c_no');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_join(){
        $query=pg_query($this->connection,"SELECT students.name, exams.score FROM students
                JOIN exams ON students.s_id=exams.s_id AND exams.c_no='CS305'");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_left_join(){
        $query=pg_query($this->connection,"SELECT students.name, exams.score FROM students
                LEFT JOIN exams ON students.s_id=exams.s_id AND exams.c_no='CS305'");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_left_join_where(){
        $query=pg_query($this->connection,"SELECT students.name, exams.score FROM students
                LEFT JOIN exams ON students.s_id=exams.s_id WHERE exams.c_no='CS305'");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_subquery_1(){
        $query=pg_query($this->connection,"SELECT name, (SELECT score FROM exams WHERE exams.s_id=students.s_id AND exams.c_no ='CS305') FROM students");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_subquery_2(){
        $query=pg_query($this->connection,"SELECT * FROM exams WHERE (SELECT start_year FROM students WHERE exams.s_id=students.s_id )>2014");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_subquery_3(){
        $query=pg_query($this->connection,"SELECT name, start_year FROM students WHERE s_id IN (SELECT s_id FROM exams WHERE c_no='CS305')");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_subquery_4(){
        $query=pg_query($this->connection,"SELECT name, start_year FROM students WHERE s_id NOT IN (SELECT s_id FROM exams WHERE score<5)");
        $this->checkFail($query);
        return $this->fetch($query);
    }

    public function example_select_subquery_5(){
        $query=pg_query($this->connection,"SELECT name, start_year FROM students WHERE NOT EXISTS (SELECT s_id FROM exams WHERE exams.s_id=students.s_id AND score<5)");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_subquery_6(){
        $query=pg_query($this->connection,"SELECT s.name, ce.score FROM students s  JOIN (SELECT exams.* FROM courses, exams WHERE courses.c_no=exams.c_no AND courses.title='Базы данных') ce ON s.s_id=ce.s_id");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_subquery_7(){
        $query=pg_query($this->connection,"SELECT s.name, e.score FROM students s,  exams e, courses c WHERE s.s_id=e.s_id AND e.c_no=c.c_no AND c.title='Базы данных'");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_order_1(){
        $query=pg_query($this->connection,"SELECT * FROM exams ORDER BY score, s_id, c_no DESC");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_group_1(){
        $query=pg_query($this->connection,"SELECT count(*) as count_all, count(DISTINCT s_id), avg(score) FROM exams");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_group_2(){
        $query=pg_query($this->connection,"SELECT c_no, count(*) as count_all, count(DISTINCT s_id), avg(score) FROM exams GROUP BY c_no");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_group_3(){
        $query=pg_query($this->connection,"SELECT s.name FROM students s, exams e  WHERE s.s_id=e.s_id AND e.score=5 GROUP BY s.name HAVING count(*)>1");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_update(){
        $query=pg_query($this->connection,"UPDATE courses SET hours=hours*2 WHERE c_no='CS301'");
        $this->checkFail($query);
        return $this->fetch($query);
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
    public function example_like_1(){
        $query=pg_query($this->connection,"select txt from course_chapters where txt like '%база данных%' ");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_like_2(){
        $query=pg_query($this->connection,"select txt from course_chapters where txt like '%базу данных%' ");
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
    public function example_fullsearch_1(){
        $query=pg_query($this->connection,"select ch_title from course_chapters
                where txtvector @@ to_tsquery('russian','базы & данные')");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_fullsearch_2(){
        $query=pg_query($this->connection,"select ch_title, ts_rank_cd('{0.1, 0.0, 1.0, 0.0}',txtvector, q) from course_chapters, to_tsquery('russian','базы & данные') q
                where txtvector @@ q order by ts_rank_cd desc");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_fullsearch_3(){
        $query=pg_query($this->connection,"select ts_headline('russian', txt,
               to_tsquery('russian','мир'),'StartSel=<b>,StopSel=</b>, MaxWords=50, MinWords=5') from course_chapters where to_tsvector('russian', txt) @@ to_tsquery('russian','мир')");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_json_1(){
        $query=pg_query($this->connection,"select s.name, sd.details FROM student_details sd, students s WHERE s.s_id=sd.s_id");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_json_2()
    {
        $query = pg_query($this->connection, "select s.name, sd.details FROM student_details sd, students s 
                WHERE s.s_id=sd.s_id and sd.details->>'достоинства' is not null");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_json_3(){
        $query=pg_query($this->connection,"select s.name, sd.details FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details->>'достоинства' is not null and sd.details ->> 'достоинства'!= 'отсутствуют'");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_json_4(){
        $query=pg_query($this->connection,"select s.name, sd.details FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details->>'гитары' is not null");
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_json_5(){
        $query=pg_query($this->connection,"select sd.de_id, s.name, sd.details #> '{хобби,гитарист,гитары}' FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details #> '{хобби,гитарист,гитары}' is not null");
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

    public function example_jsonb_select_1(){
        $query=pg_query($this->connection,<<<QUERY
        select s.name, jsonb_pretty(sd.details_b) json FROM student_details sd,students s 
        where s.s_id=sd.s_id and sd.details_b @>'{"достоинства":{"мать-героиня":{}}}'
QUERY
        );
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_jsonb_select_2(){
        $query=pg_query($this->connection,<<<QUERY
        select s.name, jsonb_each(sd.details_b) json FROM student_details sd,students s 
        where s.s_id=sd.s_id and sd.details_b @>'{"достоинства":{"мать-героиня":{}}}'
QUERY
        );
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
    public function  __destruct()
    {
        $query=pg_query($this->connection,"drop table  course_chapters, courses, exams, groups, students,student_details ");
        $this->checkFail($query);
        return $this->fetch($query);
        pg_close($this->connection);
    }
}
