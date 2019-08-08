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
        $query = pg_query($this->connection,'CREATE TABLE courses(
            c_no text PRIMARY KEY,
            title text,
            hours integer
        )');

        $query = pg_query($this->connection,'CREATE TABLE students(
            s_id integer PRIMARY KEY,
            name text,
            start_year integer
        )');


        $query = pg_query($this->connection,'CREATE TABLE exams(
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
        $query=pg_query('SELECT title AS course_title, hours FROM courses');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_all_course(){
        $query=pg_query('SELECT * FROM courses');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_repeat_column(){
        $query=pg_query('SELECT start_year FROM students');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_without_repeat_column(){
        $query=pg_query('SELECT DISTINCT start_year FROM students');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_math(){
        $query=pg_query('SELECT 2+52 AS result');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_where(){
        $query=pg_query('SELECT * FROM courses WHERE hours>45');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_many_tables(){
        $query=pg_query('SELECT * FROM courses, exams');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_many_tables_with_where(){
        $query=pg_query('SELECT courses.title, exams.s_id, exams.score FROM courses, exams WHERE courses.c_no=exams.c_no');
        $this->checkFail($query);
        return $this->fetch($query);
    }
    public function example_select_join(){
        $query=pg_query('SELECT students.name, exams.score FROM students
                JOIN exams ON students.s_id=exams.s_id AND exams.c_no="CS305"');
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
        pg_close($this->connection);
    }
}
