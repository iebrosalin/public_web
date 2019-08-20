<?php

namespace  Components\Db;

use Components\Db\MyPDOStatement;
use PDO;

class Db
{

    public static function getConnection()
    {
        $paramsPath = root().'/config/db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_STATEMENT_CLASS => array('MyPDOStatement', array()),
        );
        $db = new PDO($dsn, $params['user'], $params['password'],$options);

        $db->exec("set names utf8");

        return $db;
    }

}

