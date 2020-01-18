<?php
declare(strict_types=1);


namespace Components\Db;

use PDOException;
use PDOStatement;

/**
 * Class MyPDOStatement
 * @package Components\Db
 */
class MyPDOStatement extends PDOStatement
{
    protected $_debugValues = null;

    /**
     * MyPDOStatement constructor.
     */
    protected function __construct()
    {
        // нужен именно пустой construct()!
    }

    /**
     * @param array $values
     * @return bool
     */
    public function execute($values= [])
    {
        $this->_debugValues = $values;
        try {
            if (empty($values)) {
                $t=parent::execute();
            } else {
                $t = parent::execute($values);
            }
            // здесь можно добавить логирование успешного запроса
        } catch (PDOException $e) {
            // здесь можно добавить логирование неуспшного запроса
            throw $e;
        }

        return $t;
    }

    /**
     * @param bool $replaced
     * @return string|string[]|null
     */
    public function _debugQuery($replaced=true)
    {
        $q = $this->queryString;

        if (!$replaced) {
            return $q;
        }

        return preg_replace_callback('/:([0-9a-z_]+)/i', [$this, '_debugReplace'], $q);
    }

    /**
     * @param $m
     * @return string
     */
    protected function _debugReplace($m)
    {
        $v = $this->_debugValues[$m[1]];
        if ($v === null) {
            return "NULL";
        }
        if (!is_numeric($v)) {
            $v = str_replace("'", "''", $v);
        }

        return "'". $v ."'";
    }
}
