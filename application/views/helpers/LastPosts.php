<?php

class Application_View_Helper_LastPosts extends Zend_View_Helper_Abstract
{
    public function lastPosts()
    {
        $postModel= new Application_Model_DbTable_Posts();
        //return $this->view->partial('lastusers.phtml',['users'=>$users]);
        return $this->view->partialLoop('lastposts.phtml',$postModel->getLastPosts());
    }
}