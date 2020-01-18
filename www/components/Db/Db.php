<?php
declare(strict_types=1);

namespace  Components\Db;

use Exception;
use PDO;

/**
 * Class Db
 * @package Components\Db
 */
class Db implements \Components\Interfaces\Db
{

    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        $params = include root().'/config/db_params.php';

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_STATEMENT_CLASS => ['\Components\Db\MyPDOStatement', []],
        ];
        $db = new PDO($dsn, $params['user'], $params['password'], $options);

        $db->exec("set names utf8");

        return $db;
    }

    /**
     * @return array
     */
    public static function checkExistDb(): array
    {
        $db = self::getConnection();

        $params = include root() . '/config/db_params.php';

        $sql = 'SHOW TABLES FROM `' . $params["dbname"] . '`';

        $result = $db->prepare($sql);
        $result->execute();


        $tables = [];
        for ($i = 0; $row = $result->fetch(); ++$i) {
            $tables[$i] = $row [0];
        }

        return $tables;
    }

    /**
     * @throws Exception
     */
    public static function importDefaultDb()
    {
        $db = self::getConnection();

        $temp_line = '';
        $lines = file(root() . '/mysql.sql');

        $db->beginTransaction();
        try {
            foreach ($lines as $line) {
                // Skip it if it's a comment
                if (substr($line, 0, 2) == '--' || $line == '') {
                    continue;
                }
                $temp_line .= $line;

                if (substr(trim($line), -1, 1) == ';') {
                    $db->exec($temp_line);
                    $temp_line = '';
                }
            }
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }
}
