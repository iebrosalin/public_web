<?php

class UsersController extends Zend_Controller_Action
{

    protected $userModel = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->userModel = new Application_Model_DbTable_Users();
    }

    public function indexAction()
    {
        $this->view->users=$this->userModel->getAllUsers();
    }

    public function viewAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body

        $insertData=[
            'fullname'=> 'New User',
            'email' => 'newus@us.ru'
        ];

        $this->view->lastId=$this->userModel->addUser($insertData);
    }

    public function editAction()
    {
        // action body

        $updateData=[
            'fullname'=> 'updateUs',
            'email'=>'updateus@us.ru'
        ];
        $this->userModel->updateUser($updateData,1);
    }

    public function deleteAction()
    {
        // action body
        $this->userModel->deleteUser();

    }


}











