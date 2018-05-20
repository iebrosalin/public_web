<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once("../Db/Db.php");

$disciplines=Db::getDiscipline();
//$students=Db::getStudIdFI();
$groups=Db::getGroups();
 if(isset($_POST['sub_edit'])){
     foreach ($_POST['admission'] as $stud){
         $data=explode('/',$stud);
         Db::insertAdmission($data [0],$_POST['sub_edit'],$data [1]);
     }
     header("Location: /");
 }

require_once ("view.php");