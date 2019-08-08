<?php
require_once './vendor/autoload.php';

function p($data){
    echo '<pre>'.print_r($data,true).'</pre>';
}
error_reporting(0);
$db = new Services\MyQuery();
//$db->create_tables();
//$db->filling_tables();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <title>Pg</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-10">
            <h2 class="text-center">Пробуем SQL</h2>
            <h3>Создание таблиц и наполнение</h3>
            <h5>Запрос 1:</h5>
            <pre>CREATE TABLE courses(
                c_no text PRIMARY KEY,
                title text,
                hours integer
                )</pre>
            <pre>CREATE TABLE students(
                s_id integer PRIMARY KEY,
                name text,
                start_year integer
                )</pre>
            <pre>CREATE TABLE exams(
                s_id integer REFERENCES students(s_id),
                c_no text REFERENCES courses(c_no),
                score integer,
                CONSTRAINT pk PRIMARY KEY (s_id,c_no)
                )</pre>
            <h5>Результат:</h5>
            <h6>Таблица courses</h6>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>c_no</th>
                    <th>title</th>
                    <th>hourse</th>
                </tr>
                </thead>
            </table>
            <h6>Таблица students</h6>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>s_id</th>
                    <th>name</th>
                    <th>start_year</th>
                </tr>
                </thead>
            </table>
            <h6>Таблица  exams</h6>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>s_id</th>
                    <th>c_on</th>
                    <th>score</th>
                </tr>
                </thead>
            </table>
            <h5>Запрос 2:</h5>
            <pre>INSERT INTO  courses(c_no, title, hours)
                VALUES
                ('CS301', 'Базы данных', 30),
                ('CS305', 'Сети ЭВМ', 60)")</pre>
            <pre>INSERT INTO  students(s_id, name, start_year)
                VALUES
                (1451, 'Анна', 2014),
                (1432, 'Виктор', 2014),
                (1556, 'Нина', 2015)</pre>
            <pre>INSERT INTO  exams(s_id, c_no, score)
                VALUES
                (1451, 'CS301', 5),
                (1556, 'CS301', 5),
                (1451, 'CS305', 5),
                (1432, 'CS305', 4)</pre>
            <h5>Результат:</h5>
            <?php
            foreach ($db->get_all_tables() as $table_name=>$table):?>
                <?php                echo \Services\RenderView::table($table,'Таблица '.$table_name);?>
            <?php endforeach; ?>
            <hr>
            <h3>Выборка данных SELECT</h3>
            <h5>Запрос 1:</h5>
            <pre>SELECT title AS course_title, hours FROM courses</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_as())?>
            <h5>Запрос 2:</h5>
            <pre>SELECT * FROM courses</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_all_course())?>
            <h5>Запрос 3:</h5>
            <pre>SELECT start_year FROM students</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_repeat_column())?>
            <h5>Запрос 4:</h5>
            <pre>SELECT DISTINCT start_year FROM students</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_without_repeat_column())?>
            <h5>Запрос 5:</h5>
            <pre>SELECT 2+52 FROM result</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_math())?>
            <h5>Запрос 6:</h5>
            <pre>SELECT * FROM courses WHERE hours>45</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_where())?>
            <hr>
            <h3>Соединения JOIN</h3>
            <h5>Запрос 1:</h5>
            <pre>SELECT * FROM courses, exams</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_many_tables())?>
            <h5>Запрос 2:</h5>
            <pre>SELECT * FROM courses, exams</pre>
            <h5>Результат: логическое произведение двух таблиц (каждой строке сопоставляется все строки другой таблицы). 2 предмета и 4 экзамена дают 8 строк.</h5>
            <?php echo \Services\RenderView::table($db->example_select_many_tables())?>
            <h5>Запрос 3:</h5>
            <pre>SELECT courses.title exams.s_id, exams.score FROM courses, exams WHERE courses.c_no=exams.c_no</pre>
            <h5>Результат: по сравнению с предыдущим запросом отфильтрованы бессмысленные сопоставления</h5>
            <?php echo \Services\RenderView::table($db->example_select_many_tables_with_where())?>
            <h5>Запрос 4:</h5>
            <pre>SELECT students.name, exams.score FROM students
                JOIN exams ON students.s_id=exams.s_id AND exams.c_no="CS305"</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_join())?>

        </div>
        <div class="col"></div>
    </div>
</div>
</body>
</html>