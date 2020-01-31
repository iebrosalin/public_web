<?php

class ContactController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
            $form = new Application_Form_Contact();

            if($this->_request->isPost() && $form->isValid($this->_request->getPost())){
                $form->populate($this->_request->getPost());
                $formValues=$form->getValues();
                $config= [
                    'auth'=>'login',
                    'username'=>'iebrosalin',
                    'password'=>'Coolermasterhaf922!',
                    'ssl'=>'tls',
                    'port'=>587
                ];

                $connection = new Zend_Mail_Transport_Smtp('smtp.gmail.com',$config);

                $mail = new Zend_mail('utf-8');
                $mail->setBodyHtml($formValues ['email'].'<br/>'. $formValues['text']);
                $mail->addTo($formValues ['email']);
                $mail->setSubject('ZF mail from Me');

                if(!is_null($formValues['file']) && $form->file->receive()){
                    $file =$mail->createAttachment(file_get_contents('files/'.$formValues['file']));
                    $file->filename=$formValues['file'];
                }

                $mail->send($connection);

                $form->reset();
            }
            $this->view->form=$form;
    }


}

