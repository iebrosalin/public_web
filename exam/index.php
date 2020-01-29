<?php

$disciplines=Db::getDiscipline();
$groups=Db::getGroups();
if (isset($_POST['exam_show']) and isset($_POST['discipline']) and isset($_POST['num_grp'])) {
    $students = Db::getGroupStud($_POST['num_grp']);
}
if(isset($_POST['exam_edit'])){
    foreach ($_POST['mark'] as $stud){
        $data=explode('/',$stud);
        Db::insertMark($data [0],$_POST['exam_edit'],$data [1]);
    }
    unset($_POST['exam_edit']);
//    header("Location: /#exam");
}
require_once ("view.php");