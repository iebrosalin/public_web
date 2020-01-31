<?php

class CommentsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $commentModel=new Application_Model_Comments();
        //$this->view->assign('comments',$commentModel->getAllComments());
        $this->view->comments=$commentModel->getAllComments();
    }


}



