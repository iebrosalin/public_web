<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';

    public function getAllUsers()
    {
        return $this->fetchAll()->toArray();
    }

    public function addUser($data)
    {
        $this->insert($data);
        return $this->getAdapter()->lastInsertId();
    }

    public  function  updateUser($data,$id)
    {
        $where=$this->getAdapter()->quoteInto('id=?',$id);
        $this->update($data,$where);
    }

    public function deleteUser()
    {
        $query=$this->select()
            ->from(
            $this->_name,
            'MAX(id) as last'
        );
        $id = $this->fetchRow($query)->last;
        $this->delete('id='.$id);
        return $id;
    }

}

