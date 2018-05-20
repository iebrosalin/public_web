<?php
require_once("../Db/Db.php");
$disciplines=Db::getDiscipline();
$groups=Db::getGroups();
if (isset($_POST['sub_show']) and isset($_POST['discipline']) and isset($_POST['num_grp'])) {
    $students = Db::getGroupStud($_POST['num_grp']);
}
if(isset($_POST['sub_edit'])){
    foreach ($_POST['mark'] as $stud){
        $data=explode('/',$stud);
        Db::insertMark($data [0],$_POST['sub_edit'],$data [1]);
    }
    header("Location: /");
}

require_once ("view.php");