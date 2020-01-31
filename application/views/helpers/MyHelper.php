<?php

class Application_View_Helper_MyHelper extends Zend_View_Helper_Abstract
{
    public function myHelper()
    {
        $users=[
          ['id'=>1,'fullname'=>'f1'],
            ['id'=>2,'fullname'=>'f2'],
            ['id'=>3,'fullname'=>'f3'],
        ];
        //return $this->view->partial('lastusers.phtml',['users'=>$users]);
        return $this->view->partialLoop('lastusers.phtml',$users);
    }
}