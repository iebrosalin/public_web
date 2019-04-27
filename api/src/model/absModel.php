<?php

namespace Model;

class AbsModel{
    public static function getConnection()
    {
        $params = [
            'host' => 'localhost',
            'dbname' => 'sibers_test',
            'user' => 'root',
            'password' => '',
        ];

        // Устанавливаем соединение
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8";
        $db = new \PDO($dsn, $params['user'], $params['password']);

        // Задаем кодировку
        $db->exec("set names utf8");

        return $db;
    }
}