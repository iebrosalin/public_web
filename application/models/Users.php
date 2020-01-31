<?php

class Application_Model_Users
{
    public function getAllusers(){
        return [
          ['id'=>1,'login'=>'user 1','email'=>'user1@gmail.com'],
          ['id'=>2,'login'=>'user 2','email'=>'user2@gmail.com'],
          ['id'=>3,'login'=>'user 3','email'=>'user3@gmail.com'],
        ];
    }

}

