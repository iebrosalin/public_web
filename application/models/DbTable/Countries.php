<?php

class Application_Model_DbTable_Countries extends Zend_Db_Table_Abstract
{

    protected $_name = 'countries';

    public function getCountriesByArray()
    {
        return $this->fetchAll()->toArray();
    }

    public function getCountriesByPaginatorAdapter()
    {
        return new Zend_Paginator_Adapter_DbSelect($this->select());
    }
}

