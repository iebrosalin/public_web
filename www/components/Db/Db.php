<?php

namespace  Components\Db;

use PDO;


class Db
{

    public static function getConnection(): PDO
    {
        $params = include(root().'/config/db_params.php');

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8";
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_STATEMENT_CLASS => array('\Components\Db\MyPDOStatement', array()),
        );
        $db = new PDO($dsn, $params['user'], $params['password'],$options);

        $db->exec("set names utf8");

        return $db;
    }

    public static function checkExistDb(): array
    {
        $db = self::getConnection();

        $params = include(root() . '/config/db_params.php');

        $sql = 'SHOW TABLES FROM `' . $params["dbname"] . '`';

        $result = $db->prepare($sql);
        $result->execute();


        $tables = array();
        for ($i = 0; $row = $result->fetch(); ++$i) {
            $tables[$i] = $row [0];
        }

        return $tables;
    }

    public static function importDefaultDb()
    {
            $db = self::getConnection();

            $templine = '';
            $lines = file(root() . '/mysql.sql');

            $db->beginTransaction();
        try {
            foreach ($lines as $line) {
                // Skip it if it's a comment
                if (substr($line, 0, 2) == '--' || $line == '') {
                    continue;
                }
                $templine .= $line;

                if (substr(trim($line), -1, 1) == ';') {
                    $db->exec($templine);
                    $templine = '';
                }
            }
            $db->commit();
        } catch (\Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }
}

