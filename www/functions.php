<?php
function debug($attr)
{
    echo '<pre>'.print_r($attr,true).'</pre>';

}

function checkExistDb(): array
{

    $sql = 'SHOW TABLES FROM `' . getenv("MYSQL_DATABASE") . '`';

    $result = Yii::$app->getDb()->getMasterPdo()->prepare($sql);
    $result->execute();


    $tables = [];
    for ($i = 0; $row = $result->fetch(); ++$i) {
        $tables[$i] = $row [0];
    }

    return $tables;
}

function importDefaultDb()
{

    $temp_line = '';
    $lines = file(__DIR__ . '/mysql.sql');

    Yii::$app->getDb()->getMasterPdo()->beginTransaction();
    try {
        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            $temp_line .= $line;

            if (substr(trim($line), -1, 1) == ';') {
                Yii::$app->getDb()->getMasterPdo()->exec($temp_line);
                $temp_line = '';
            }
        }
        Yii::$app->getDb()->getMasterPdo()->commit();
    } catch (Exception $e) {
        Yii::$app->getDb()->getMasterPdo()->rollBack();
        throw $e;
    }
}