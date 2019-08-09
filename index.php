<?php
require_once './vendor/autoload.php';

function p($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

//error_reporting(0);
$db = new Services\MyQuery();
$db->create_tables();
$db->filling_tables();


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
            <h6>Таблица exams</h6>
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
            foreach ($db->get_all_tables() as $table_name => $table):?>
                <?php echo \Services\RenderView::table($table, 'Таблица ' . $table_name); ?>
            <?php endforeach; ?>
            <hr>
            <h3>Выборка данных SELECT</h3>
            <h5>Запрос 1:</h5>
            <pre>SELECT title AS course_title, hours FROM courses</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_as()) ?>
            <h5>Запрос 2:</h5>
            <pre>SELECT * FROM courses</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_all_course()) ?>
            <h5>Запрос 3:</h5>
            <pre>SELECT start_year FROM students</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_repeat_column()) ?>
            <h5>Запрос 4:</h5>
            <pre>SELECT DISTINCT start_year FROM students</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_without_repeat_column()) ?>
            <h5>Запрос 5:</h5>
            <pre>SELECT 2+52 FROM result</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_math()) ?>
            <h5>Запрос 6:</h5>
            <pre>SELECT * FROM courses WHERE hours>45</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_where()) ?>
            <hr>
            <h3>Соединения JOIN</h3>
            <h5>Запрос 1:</h5>
            <pre>SELECT * FROM courses, exams</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_many_tables()) ?>
            <h5>Запрос 2:</h5>
            <pre>SELECT * FROM courses, exams</pre>
            <h5>Результат: логическое произведение двух таблиц (каждой строке сопоставляется все строки другой таблицы).
                2 предмета и 4 экзамена дают 8 строк.</h5>
            <?php echo \Services\RenderView::table($db->example_select_many_tables()) ?>
            <h5>Запрос 3:</h5>
            <pre>SELECT courses.title exams.s_id, exams.score FROM courses, exams WHERE courses.c_no=exams.c_no</pre>
            <h5>Результат: по сравнению с предыдущим запросом отфильтрованы бессмысленные сопоставления</h5>
            <?php echo \Services\RenderView::table($db->example_select_many_tables_with_where()) ?>
            <h5>Запрос 4:</h5>
            <pre>SELECT students.name, exams.score FROM students
                JOIN exams ON students.s_id=exams.s_id AND exams.c_no='CS305'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_join()) ?>
            <h5>Запрос 5:</h5>
            <pre>SELECT students.name, exams.score FROM students
                LEFT JOIN exams ON students.s_id=exams.s_id AND exams.c_no='CS305'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_left_join()) ?>
            <h5>Запрос 6:</h5>
            <pre>SELECT students.name, exams.score FROM students
                LEFT JOIN exams ON students.s_id=exams.s_id WHERE exams.c_no='CS305'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_left_join_where()) ?>
            <hr>
            <h3>Подзапросы</h3>
            <h5>Запрос 1:</h5>
            <pre>SELECT name, (SELECT score FROM exams WHERE exams.s_id=students.s_id AND exams.c_no ='CS305') FROM students</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_subquery_1()) ?>
            <h5>Запрос 2:</h5>
            <pre>SELECT * FROM exams WHERE (SELECT start_year FROM students WHERE exams.s_id=students.s_id )>2014</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_subquery_2()) ?>
            <h5>Запрос 3:</h5>
            <pre>SELECT name, start_year FROM students WHERE s_id IN (SELECT s_id FROM exams WHERE c_no='CS305')</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_subquery_3()) ?>
            <h5>Запрос 4:</h5>
            <pre>SELECT name, start_year FROM students WHERE s_id NOT IN (SELECT s_id FROM exams WHERE score<5)</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_subquery_4()) ?>
            <h5>Запрос 5:</h5>
            <pre>SELECT name, start_year FROM students WHERE NOT EXISTS (SELECT s_id FROM exams WHERE exams.s_id=students=s_id AND score<5)</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_subquery_5()) ?>
            <h5>Запрос 6:</h5>
            <pre>SELECT s.name, ce.score FROM students s FROM students JOIN (SELECT exams.* FROM courses, exams WHERE courses.title='Базы данных') ce ON s.s_id=ce.s_id)</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_subquery_6()) ?>
            <h5>Запрос 7:</h5>
            <pre>SELECT s.name, e.score FROM students s,  exams e WHERE s.s_id=e.s_id AND e.c_no=s.c_no AND e.title='Базы данных'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_subquery_7()) ?>
            <hr>
            <h3>Сортировка</h3>
            <h5>Запрос 1:</h5>
            <pre>SELECT * FROM exams ORDER BY score, s_id, c_no DESC</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_order_1()) ?>
            <hr>
            <h3>Группировка</h3>
            <h5>Запрос 1:</h5>
            <pre>SELECT count(*) as count_all, count(DISTINCT s_id), avg(score) FROM exams</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_group_1()) ?>
            <h5>Запрос 2:</h5>
            <pre>SELECT c_no, count(*) as count_all, count(DISTINCT s_id), avg(score) FROM exams GROUP BY c_no</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_group_2()) ?>
            <h5>Запрос 3:</h5>
            <pre>SELECT s.name FROM students s, exams e  WHERE s.s_id=e.s_id, e.score=5 ORDER BY s.name HAVING count(*)>1</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_group_3()) ?>
            <hr>
            <h3>Изменение, удаление</h3>
            <h5>Запрос 1:</h5>
            <pre>UPDATE courses SET hours=hours*2 WHERE c_no='CS301'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_select_all_course()) ?>
            <hr>
            <h3>Транзакция</h3>
            <h5>Запрос 1:</h5>
            <pre>
                CREATE TABLE IF NOT EXISTS groups(g_no text PRIMARY KEY, monitor integer NOT NULL REFERENCES students(s_id));
                ALTER TABLE students ADD g_no text REFERENCES groups(g_no);
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
            <pre>select txt from course_chapters where txt like '%база данных%' </pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_like_1()) ?>
            <h5>Запрос 2:</h5>
            <pre>select txt from course_chapters where txt like '%базу данных%'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_like_2()) ?>
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
            <pre>
                select ch_title from course_chapters
                where txtvector @@ to_tsquery('russian','базы & данные')</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_fullsearch_1()) ?>
            <h5>Запрос 4:</h5>
            <pre>
                elect ch_title ts_rank_cd('{0.1, 0.0, 1.0, 0.0}',txtvector q) from course_chapters, to_tsquery('russian','базы & данные') q
                where txtvector @@ q order by ts_rank_cd desc</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_fullsearch_2()) ?>
            <h5>Запрос 5:</h5>
            <pre>
                select ts_headline('russian', txt,
               to_tsquery('russian','мир'),'StartSel=<b>,StopSel=</b>, MaxWords=50, MinWords=5')
                from course_chapters where
                to_tsvector('russian', txt)
                @@ to_tsquery('russian','мир')</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_fullsearch_3()) ?>
            <hr>
            <h3>JSON</h3>
            <h5>Создание таблицы для экспериментов:</h5>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_get_course_chapters()) ?>
            <h5>Запрос 1:</h5>
            <pre>select s.name, sd.details FROM student_details sd, student s WHERE s.s_id=sd.s_id </pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_json_1()) ?>
            <h5>Запрос 2:</h5>
            <pre>select s.name, sd.details FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details->>'достоинства' is not null</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_json_2()) ?>
            <h5>Запрос 3:</h5>
            <pre>select s.name, sd.details FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details->>'достоинства' is not null and sd.details ->> 'достоинства'!= 'отсутствуют'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_json_3()) ?>
            <h5>Запрос 4:</h5>
            <pre>select s.name, sd.details FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details->>'гитары' is not null</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_json_4()) ?>
            <h5>Запрос 5:</h5>
            <pre>select sd.de_id, s.name, sd.details #> 'хобби,гитарист,гитары' FROM student_details sd, students s
                WHERE s.s_id=sd.s_id and sd.details #> 'хобби,гитарист,гитары' is not null</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_json_5()) ?>
            <hr>
            <h3>JSON</h3>
            <h5>Запрос 1:</h5>
            <pre>
                alter table student_details add details_b jsonb;
                update student_details set details_b=to_jsonb(details);
                select * from student_details;</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_jsonb_create()) ?>
            <h5>Запрос 2:</h5>
            <pre>
                select s.name, jsonb_pretty(sd.details_b) json FROM student_details sd,students s
        where s.s_id=sd.s_id and sd.details_b @>'{"достоинства":{"мать-героиня":{}}}'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_jsonb_select_1()) ?>
            <h5>Запрос 3:</h5>
            <pre>
                select s.name, jsonb_each(sd.details_b) json FROM student_details sd,students s
        where s.s_id=sd.s_id and sd.details_b @>'{"достоинства":{"мать-героиня":{}}}'</pre>
            <h5>Результат:</h5>
            <?php echo \Services\RenderView::table($db->example_jsonb_select_2()) ?>
        </div>
        <?php ?>
        <div class="col"></div>
    </div>
</div>
</body>
</html>