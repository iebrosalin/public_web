<?php


$disciplines=Db::getDiscipline();
$students=Db::getStudIdFI();
$groups=Db::getGroups();
 if(isset($_POST['admission_edit'])){
     foreach ($_POST['admission'] as $stud){
         $data=explode('/',$stud);
         Db::insertAdmission($data [0],$_POST['admission_edit'],$data [1]);
     }
     unset($_POST['admission_edit']);
//     header("Location: /#admission");
 }

require_once ("view.php");