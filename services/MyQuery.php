<?php
namespace Services;

use Exception;

class MyQuery{
    private $connection;
    public function __construct()
    {

        /*
         * Connection settings
         */
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

    public function create_tables()
    {
        $query = pg_query($this->connection,'CREATE TABLE if not exists courses(
            c_no text PRIMARY KEY,
            title text,
            hours integer 
        )');

        $query = pg_query($this->connection,'CREATE TABLE if not exists  students(
            s_id integer PRIMARY KEY,
            name text,
            start_year integer
        )');


        $query = pg_query($this->connection,'CREATE TABLE if not exists  exams(
            s_id integer REFERENCES students(s_id),
            c_no text REFERENCES courses(c_no),
            score integer,
            CONSTRAINT pk PRIMARY KEY (s_id,c_no)
        )');

        $this->checkFail($query);

    }

    public function filling_tables()
    {
        $query = pg_query($this->connection,"INSERT INTO  courses(c_no, title, hours)
            VALUES ('CS301', 'Базы данных', 30),
                   ('CS305', 'Сети ЭВМ', 60)");
        $query= pg_query($this->connection,"INSERT INTO  students(s_id, name, start_year)
            VALUES (1451, 'Анна', 2014),
                   (1432, 'Виктор', 2014),
                   (1556, 'Нина', 2015)");
        $query = pg_query($this->connection,"INSERT INTO  exams(s_id, c_no, score)
            VALUES (1451, 'CS301', 5),
                   (1556, 'CS301', 5),
                   (1451, 'CS305', 5),
                   (1432, 'CS305', 4)
                   ");


        $this->checkFail($query);
    }

    public function  get_all_tables(){
        $res=[];
        $queryCourse = pg_query($this->connection,"SELECT * FROM courses");
        while($row=pg_fetch_assoc($queryCourse)){
            $res['course'][]=$row;
        }
        $queryStudent = pg_query($this->connection,"SELECT * FROM students");
        while($row=pg_fetch_assoc($queryStudent)){
            $res['student'][]=$row;
        }
        $queryExam = pg_query($this->connection,"SELECT * FROM exams");
        while($row=pg_fetch_assoc($queryExam)){
            $res['exam'][]=$row;
        }
        return $res;
    }

    public function simple_query(){

    }

    public function example_select_as(){
        $query=pg_query($this->connection,'SELECT title AS course_title, hours FROM courses');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_all_course(){
        $query=pg_query($this->connection,'SELECT * FROM courses');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_repeat_column(){
        $query=pg_query($this->connection,'SELECT start_year FROM students');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_without_repeat_column(){
        $query=pg_query($this->connection,'SELECT DISTINCT start_year FROM students');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_math(){
        $query=pg_query($this->connection,'SELECT 2+52 AS result');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_where(){
        $query=pg_query($this->connection,'SELECT * FROM courses WHERE hours>45');
        $this->checkFail($query);
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
//        $query=pg_send_query($this->connection,
//            " CREATE TABLE IF NOT EXISTS groups(g_no text PRIMARY KEY, monitor integer NOT NULL REFERENCES students(s_id));
//                ALTER TABLE students ADD g_no text REFERENCES groups(g_no);
//                BEGIN;
//                INSERT INTO groups(g_no,monitor) SELECT 'A-101', s_id FROM students WHERE name='Анна';
//                UPDATE students SET g_no='A-101';
//                COMMIT;"
//        );
        $query=pg_query($this->connection,
            " CREATE TABLE IF NOT EXISTS groups(g_no text PRIMARY KEY, monitor integer NOT NULL REFERENCES students(s_id));"
        );
        $query=pg_query($this->connection,
            " ALTER TABLE students ADD g_no text REFERENCES groups(g_no);"
        );

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

//
//        try {
//            $dbh = new PDO('odbc:SAMPLE', 'db2inst1', 'ibmdb2',
//                array(PDO::ATTR_PERSISTENT => true));
//            echo "Подключились\n";
//        } catch (Exception $e) {
//            die("Не удалось подключиться: " . $e->getMessage());
//        }
//
//        try {
//            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//            $dbh->beginTransaction();
//            $dbh->exec("insert into staff (id, first, last) values (23, 'Joe', 'Bloggs')");
//            $dbh->exec("insert into salarychange (id, amount, changedate)
//      values (23, 50000, NOW())");
//            $dbh->commit();
//
//        } catch (Exception $e) {
//            $dbh->rollBack();
//            echo "Ошибка: " . $e->getMessage();
//        }


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
        $query=pg_query($this->connection,"drop table courses, exams, groups, students");
        $this->checkFail($query);
        return $this->fetch($query);
        pg_close($this->connection);
    }
}
