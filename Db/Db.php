<?php

class Db
{
    public static function getConnection()
    {
        $params = array(
            'host' => 'localhost',
            'dbname' => 'univer',
            'user' => 'root',
            'password' => '',
        );

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8";
        $db = new PDO($dsn, $params['user'], $params['password']);

        $db->exec("set names utf8");

        return $db;
    }

    public static function getDiscipline(){
        $db = Db::getConnection();
        $sql = 'SELECT title FROM discipline';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data=array();
        $i=0;
        while ($row=$result->fetch()){
            $data[$i] ['title'] = $row ['title'];
            $i++;
        }
        return $data;
    }
    public static function getStudIdFI(){
        $db = Db::getConnection();
        $sql = 'SELECT name, soname, id FROM stud';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data=array();
        $i=0;
        while ($row=$result->fetch()){
            $data[$i] ['name'] = $row ['name'];
            $data[$i] ['soname'] = $row ['soname'];
            $data[$i] ['id'] = $row ['id'];
            $i++;
        }
        return $data;
    }
    public static function  getIdDisciplineByTitle($title){
        $db = Db::getConnection();
        $sql = 'SELECT id FROM discipline WHERE title=:title';
        $result = $db->prepare($sql);
        $result->bindParam(':title', $title , PDO::PARAM_STR);
        $result->execute();
        return $result->fetch();
    }
    public static function getAdmissionByIdStud($id, $discipline){
        $id_disc=Db::getIdDisciplineByTitle($discipline);
        $db = Db::getConnection();
        $sql = 'SELECT admission FROM exam WHERE id_stud=:id_stud AND id_discipline=:id_disc ';
        $result = $db->prepare($sql);
        $result->bindParam(':id_stud', $id, PDO::PARAM_INT);
        $result->bindParam(':id_disc', $id_disc['id'], PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    public static function insertAdmission ($id, $discipline, $admission){
        $discipline=Db::getIdDisciplineByTitle($discipline);
        $db = Db::getConnection();
        $sql = 'UPDATE exam SET  admission=:adm  WHERE id_stud=:id_stud AND id_discipline=:id_disc ';
        $result = $db->prepare($sql);
        $result->bindParam(':id_stud', $id, PDO::PARAM_INT);
        $result->bindParam(':id_disc', $discipline [0], PDO::PARAM_INT);
        $result->bindParam(':adm', $admission, PDO::PARAM_INT);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
    }
    public static  function  getStudFIbyId($id){
        $db = Db::getConnection();
        $sql = 'SELECT name, soname FROM stud WHERE id=:id_stud';
        $result = $db->prepare($sql);
        $result->bindParam(':id_stud', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public  static  function  getGroups(){
        $db = Db::getConnection();
        $sql = 'SELECT num_grp FROM stud GROUP BY num_grp';
        $result = $db->prepare($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data=array();
        $i=0;
        while ($row=$result->fetch()){
            $data[$i] ['num_grp'] = $row ['num_grp'];
            $i++;
        }
        return $data;
    }

    public static  function getGroupStud($num_grp){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM stud WHERE num_grp=:grp';
        $result = $db->prepare($sql);
        $result->bindParam(':grp', $num_grp, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data=array();
        $i=0;
        while ($row=$result->fetch()){
            $data[$i] ['name'] = $row ['name'];
            $data[$i] ['soname'] = $row ['soname'];
            $data[$i] ['id_zachot'] = $row ['id_zachot'];
            $data[$i] ['id'] = $row ['id'];
            $i++;
        }
        return $data;
    }
    public static function insertMark ($id, $discipline, $mark){
        $discipline=Db::getIdDisciplineByTitle($discipline);
        $db = Db::getConnection();
        $sql = 'UPDATE exam SET  mark=:mark  WHERE id_stud=:id_stud AND id_discipline=:id_disc ';
        $result = $db->prepare($sql);
        $result->bindParam(':id_stud', $id, PDO::PARAM_INT);
        $result->bindParam(':id_disc', $discipline [0], PDO::PARAM_INT);
        $result->bindParam(':mark', $mark, PDO::PARAM_INT);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
    }
    public static function getMarkByIdStud($id, $discipline){
        $id_disc=Db::getIdDisciplineByTitle($discipline);
        $db = Db::getConnection();
        $sql = 'SELECT mark FROM exam WHERE id_stud=:id_stud AND id_discipline=:id_disc ';
        $result = $db->prepare($sql);
        $result->bindParam(':id_stud', $id, PDO::PARAM_INT);
        $result->bindParam(':id_disc', $id_disc['id'], PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    public static  function Studs($num_grp){
        $db = Db::getConnection();
        $sql = 'SELECT * FROM stud ';
        $result = $db->prepare($sql);
        $result->bindParam(':grp', $num_grp, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $data=array();
        $i=0;
        while ($row=$result->fetch()){
            $data[$i] ['name'] = $row ['name'];
            $data[$i] ['soname'] = $row ['soname'];
            $data[$i] ['id_zachot'] = $row ['id_zachot'];
            $data[$i] ['id'] = $row ['id'];
            $data[$i] ['num_grp'] = $row ['num_grp'];
            $i++;
        }
        return $data;
    }
}

