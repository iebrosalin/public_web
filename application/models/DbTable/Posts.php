<?php

class Application_Model_DbTable_Posts extends Zend_Db_Table_Abstract
{

    protected $_name = 'posts';

    public function  getSqlSave()
    {
        $query=$this->select()
            ->from($this->_name,'text')
            ->where('id=?','1')
            ->where('text=?','Имеется спорная точка зрения, гласящая примерно следующее: стремящиеся вытеснить традиционное производство, нанотехнологии представляют собой не что иное, как квинтэссенцию победы маркетинга над разумом и должны быть разоблачены.');
           // ->orWhere('id=?',2);
//            ->order('text DESC')
//            ->limit(3,3);
        //print_r($query->assemble());
        return $this->fetchAll($query)->toArray();
    }

    public function  countPosts()
    {
        $query=$this->select()->from($this->_name,'MIN(id) AS number');
        return $this->fetchRow($query)->number;
    }
    public function  joinTables()
    {
        $query=$this->select()->setIntegrityCheck(false)
            -> from(['p'=>'posts'],['p.text'])
            ->join(['c'=>'comments'], 'p.id=c.post_id',['c.id AS comment_id', 'c.comment', 'c.post_id']);
        return $this->fetchAll($query)->toArray();
    }

    public  function  insertNewPost($data){
        $this->insert($data);
        return $this->getAdapter()->lastInsertId();
    }
    public function updatePostById($data, $id)
    {
        $where=$this->getAdapter()->quoteInto('id=?',$id);
        //$where.=" AND ";
        //$where.= $this->getAdapter()->quoteInto('active=?',1);
        $this->update($data,$where);
    }
    public function deletePostById( $id)
    {
        $where=$this->getAdapter()->quoteInto('id=?',$id);
        $this->delete($where);
    }

    public function myQuery(){
        $this->getAdapter()->query('ALTER TABLE posts ADD date TIMESTAMP ');
    }

    public function getLastPosts(){
        return $this->fetchAll(null,'id DESC','5')->toArray();
    }

    public function getAllPosts(){
        return $this->fetchAll()->toArray();
    }

    public function addPost(){
        $data=[
            'text'=>'NEW POST'
        ];
        $this->insert($data);

        Zend_Registry::get('cache')->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,['allPosts']);
    }

    public function getPostsByPaginatorAdapter()
    {
        return new Zend_Paginator_Adapter_DbSelect($this->select());
    }
}

