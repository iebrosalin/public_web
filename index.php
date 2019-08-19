<?php
require_once './vendor/autoload.php';
use Services\MyQuery;

function p($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

//error_reporting(0);
$db = new MyQuery();
MyQuery::initDb($db);


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
    <div class="row justify-content-center">
        <div class="col-10 ">
            <h2 class="text-center">Пробуем SQL</h2>
            <h3>Создание таблиц и наполнение</h3>
            <h5>Запрос 1:</h5>
           <?= \Services\RenderView::query(MyQuery::getCreateTableQuery())?>
            <h5>Запрос 2:</h5>
            <?= \Services\RenderView::query(MyQuery::getFillTableQuery())?>
            <?php
            foreach ($db->get_all_tables() as $table_name => $table):?>
                <?php echo \Services\RenderView::table($table, 'Таблица ' . $table_name); ?>
            <?php endforeach; ?>
            <hr>
            <h3>Выборка данных SELECT</h3>
            <h5>Запрос 1:</h5>
            <?= \Services\RenderView::tableWithQuery('SELECT title AS course_title, hours FROM courses')?>
            <h5>Запрос 2:</h5>
            <?= \Services\RenderView::tableWithQuery('SELECT * FROM courses')?>
            <h5>Запрос 3:</h5>
            <?= \Services\RenderView::tableWithQuery('SELECT DISTINCT start_year FROM students')?>
            <h5>Запрос 4:</h5>
            <?= \Services\RenderView::tableWithQuery('SELECT DISTINCT start_year FROM students')?>
            <h5>Запрос 5:</h5>
            <?= \Services\RenderView::tableWithQuery('SELECT 2+52 AS result')?>
            <h5>Запрос 6:</h5>
            <?= \Services\RenderView::tableWithQuery('SELECT * FROM courses WHERE hours>45')?>
            <hr>
            <h3>Соединения JOIN</h3>
            <h5>Запрос 1:</h5>
            <?= \Services\RenderView::tableWithQuery('SELECT * FROM courses, exams')?>
            <h5>Запрос 2:</h5>
            <?= \Services\RenderView::tableWithQuery('SELECT courses.title, exams.s_id, exams.score FROM courses, exams WHERE courses.c_no=exams.c_no')?>
            <h5>Запрос 3:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT students.name, exams.score FROM students
                JOIN exams ON students.s_id=exams.s_id AND exams.c_no='CS305'")?>

            <h5>Запрос 4:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT students.name, exams.score FROM students
                LEFT JOIN exams ON students.s_id=exams.s_id AND exams.c_no='CS305'")?>
            <h5>Запрос 5:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT students.name, exams.score FROM students
                LEFT JOIN exams ON students.s_id=exams.s_id WHERE exams.c_no='CS305'")?>
            <h5>Запрос 6:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT name, (SELECT score FROM exams WHERE exams.s_id=students.s_id AND exams.c_no ='CS305') FROM students")?>
            <hr>
            <h3>Подзапросы</h3>
            <h5>Запрос 1:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT name, (SELECT score FROM exams WHERE exams.s_id=students.s_id AND exams.c_no ='CS305') FROM students")?>
            <h5>Запрос 2:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT * FROM exams WHERE (SELECT start_year FROM students WHERE exams.s_id=students.s_id )>2014")?>
            <h5>Запрос 3:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT name, start_year FROM students WHERE s_id IN (SELECT s_id FROM exams WHERE c_no='CS305')")?>
            <h5>Запрос 4:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT name, start_year FROM students WHERE s_id NOT IN (SELECT s_id FROM exams WHERE score<5)")?>
            <h5>Запрос 5:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT name, start_year FROM students WHERE NOT EXISTS (SELECT s_id FROM exams WHERE exams.s_id=students.s_id AND score<5)")?>
            <h5>Запрос 6:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT s.name, ce.score FROM students s  JOIN (SELECT exams.* FROM courses, exams WHERE courses.c_no=exams.c_no AND courses.title='Базы данных') ce ON s.s_id=ce.s_id")?>
            <h5>Запрос 7:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT s.name, e.score FROM students s,  exams e, courses c WHERE s.s_id=e.s_id AND e.c_no=c.c_no AND c.title='Базы данных'")?>
            <hr>
            <h3>Сортировка</h3>
            <h5>Запрос 1:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT * FROM exams ORDER BY score, s_id, c_no DESC")?>
            <hr>
            <h3>Группировка</h3>
            <h5>Запрос 1:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT count(*) as count_all, count(DISTINCT s_id), avg(score) FROM exams")?>
            <h5>Запрос 2:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT c_no, count(*) as count_all, count(DISTINCT s_id), avg(score) FROM exams GROUP BY c_no")?>
            <h5>Запрос 3:</h5>
            <?= \Services\RenderView::tableWithQuery("SELECT s.name FROM students s, exams e  WHERE s.s_id=e.s_id AND e.score=5 GROUP BY s.name HAVING count(*)>1")?>
            <hr>
            <h3>Изменение, удаление</h3>
            <h5>Запрос 1:</h5>
            <?= \Services\RenderView::tableWithQuery("UPDATE courses SET hours=hours*2 WHERE c_no='CS301'")?>
            <hr>
            <h3>Транзакция</h3>
            <h5>Запрос 1:</h5>
            <pre>
                BEGIN;
                INSERT INTO groups(g_no,monitor) SELECT 'A-101', s_id FROM students WHERE name='Анна';
                UPDATE students SET g_no='A-101';
                COMMIT;
                SELECT * FROM students;
            </pre>
            <h5>Результат:</h5>
            <?php $db->example_transaction()?>
            <?php echo \Services\RenderView::table($db->example_get_groups(),'groups') ?>
            <?php echo \Services\RenderView::table($db->example_get_students(),'student') ?>
            <hr>
            <h3>Полнотекстовый поиск</h3>
            <h5>Создание таблицы для экспериментов:</h5>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_get_course_chapters()) ?>
            <h5>Запрос 1:</h5>
            <?= \Services\RenderView::tableWithQuery("select txt from course_chapters where txt like '%база данных%' ")?>
            <h5>Запрос 2:</h5>
            <?= \Services\RenderView::tableWithQuery("select txt from course_chapters where txt like '%базу данных%' ")?>
            <h5>Добавление полнотекстового поиска:</h5>
            <pre>
                alter table course_chapters add txtvector tsvector;
                update course_chapter set txtvector=to_tsvector('russian',txt);
                select txtvector from course_chapters;</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_create_fullsearch()) ?>
            <h5>Модификация полнотекстового поиска:</h5>
            <pre>
                update course_chapters set txtvector=setweight(to_tsvector('russian',ch_title),'B') || ''
                || setweight(to_tsvector('russian',txt),'D');
                select * from course_chapters
                </pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_create_fullsearch_2()) ?>
            <h5>Запрос 3:</h5>
            <?= \Services\RenderView::tableWithQuery("select ch_title from course_chapters
                where txtvector @@ to_tsquery('russian','базы & данные')")?>
            <h5>Запрос 4:</h5>
            <?= \Services\RenderView::tableWithQuery("select ch_title, ts_rank_cd('{0.1, 0.0, 1.0, 0.0}',txtvector, q) from course_chapters, to_tsquery('russian','базы & данные') q
                where txtvector @@ q order by ts_rank_cd desc")?>
            <h5>Запрос 5:</h5>
            <?= \Services\RenderView::tableWithQuery("select ts_headline('russian', txt,
               to_tsquery('russian','мир'),'StartSel=<b>,StopSel=</b>, MaxWords=50, MinWords=5') from course_chapters where to_tsvector('russian', txt) @@ to_tsquery('russian','мир')")?>
            <hr>
            <h3>JSON</h3>
            <h5>Создание таблицы для экспериментов:</h5>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_get_course_chapters()) ?>
            <h5>Запрос 1:</h5>
            <?= \Services\RenderView::tableWithQuery("select s.name, sd.details FROM student_details sd, students s WHERE s.s_id=sd.s_id")?>
            <h5>Запрос 2:</h5>
            <?= \Services\RenderView::tableWithQuery("select s.name, sd.details FROM student_details sd, students s 
                WHERE s.s_id=sd.s_id and sd.details->>'достоинства' is not null")?>
            <h5>Запрос 3:</h5>
            <?= \Services\RenderView::tableWithQuery("select s.name, sd.details FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details->>'достоинства' is not null and sd.details ->> 'достоинства'!= 'отсутствуют'")?>
            <h5>Запрос 4:</h5>
            <?= \Services\RenderView::tableWithQuery("select s.name, sd.details FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details->>'гитары' is not null")?>
            <h5>Запрос 5:</h5>
            <?= \Services\RenderView::tableWithQuery("select sd.de_id, s.name, sd.details #> '{хобби,гитарист,гитары}' FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details #> '{хобби,гитарист,гитары}' is not null")?>
            <hr>
            <h3>JSONB</h3>
            <h5>Запрос 1:</h5>
            <pre>
                alter table student_details add details_b jsonb;
                update student_details set details_b=to_jsonb(details);
                select * from student_details;</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_jsonb_create()) ?>
            <h5>Запрос 2:</h5>
            <?= \Services\RenderView::tableWithQuery(<<<QUERY
                    select s.name, jsonb_pretty(sd.details_b) json FROM student_details sd,students s 
                    where s.s_id=sd.s_id and sd.details_b @>'{"достоинства":{"мать-героиня":{}}}'
            QUERY)?>
            <h5>Запрос 3:</h5>
            <?= \Services\RenderView::tableWithQuery(<<<QUERY
        select s.name, jsonb_each(sd.details_b) json FROM student_details sd,students s 
        where s.s_id=sd.s_id and sd.details_b @>'{"достоинства":{"мать-героиня":{}}}'
QUERY);
           $db->clear_all();
            ?>
        </div>

    </div>
</div>
</body>
</html></html>