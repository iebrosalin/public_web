<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        /******  Начало кэша  из файла*******/
//        $this->view->start=microtime(true);
//
//        $frontendOptions=[
//            'lifetime'=>7200,
//            'automatic_serialization'=> true,
//        ];
//
//        $backendoptions=[
//            'cache_dir'=>APPLICATION_PATH.'/../cache',
//        ];
//
//        $cache= Zend_Cache::factory('Core','File',$frontendOptions,$backendoptions);
//        $id ='posts';
//
//        if(!($this->view->posts=$cache->load($id)))
//        {
//            $postsModel= new Application_Model_DbTable_Posts();
//            $this->view->posts=$postsModel->getAllPosts();
//            $cache->save( $this->view->posts,$id,['1','2']);
//        }
//
//        $cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,['12']);

        /******  Конец кэша  из файла*******/


        /******  Начало кэша  из классов*******/
//        $this->view->start=microtime(true);
//
//        $frontendOptions=[
//            'lifetime'=>7200,
//            'automatic_serialization'=> true,
//            'cached_entity'=> new Application_Model_DbTable_Posts(),
//        ];
//
//        $backendoptions=[
//            'cache_dir'=>APPLICATION_PATH.'/../cache',
//        ];
//
//        $cache= Zend_Cache::factory('class','File',$frontendOptions,$backendoptions);
//        $this->view->posts=$cache->getAllPosts();
//
        //$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,['12']);

        /******  Конец кэша  классов*******/

        /******  Начало кэшировании функции*******/
//        $this->view->start=microtime(true);

//        $frontendOptions=[
//            'lifetime'=>7200,
//            'automatic_serialization'=> true,
//            'cache_by_default'=> false,
//            'cached_functions'=>['Application_Model_DbTable_Posts::getAllPosts'],
//        ];
//
//        $backendoptions=[
//            'cache_dir'=>APPLICATION_PATH.'/../cache',
//        ];
//
//        $cache= Zend_Cache::factory('function','File',$frontendOptions,$backendoptions);
//
//            $postsModel= new Application_Model_DbTable_Posts();
//            $this->view->posts=$cache->call([$postsModel,'getAllPosts']);


        /******  Конец кэшировании функции*******/

        /******  Начало упражнения по кэшированию *******/

//        $this->view->start=microtime(true);
//
//        $postsModel= new Application_Model_DbTable_Posts();
        //$postsModel->addPost();
//        $this->view->posts=Zend_Registry::get('cache')->call([$postsModel,'getAllPosts'],[],['allPosts']);

        /******  Конец упражнения по кэшированию*******/

/******** Начало Работа с моделями в ZF ********/
        //$data = $postsModel->fetchAll()->toArray();
        //$data=$postModel->find(3)->toArray();
        //$data = $postsModel->fetchAll('id=3 OR id=7')->toArray();
        //$data = $postsModel->fetchAll(null,'id DESC')->toArray();
        //$data = $postsModel->fetchAll(null,null,5,2)->toArray();
//        $newPost=[
//            'text'=>'New text'
//        ];
//        $lastId=$postsModel->insertNewPost($newPost);

        //$this->view->lastid=$lastId;
        //$this->view->posts=$postsModel->getSqlSave();
//        $updatePost=[
//            'text'=> 'update'
//        ];
//        $postsModel->updatePostById($updatePost,1);
       // $postsModel->deletePostById(1);
       // $postsModel->myQuery();
        //$this->view->posts=$postsModel->fetchAll()->toArray();
        /******** Конец Работа с моделями в ZF ********/

        /***** Начало Передача данных *****/
      // echo $this->_request->getParam('a',100);
//        $cart = new Zend_Session_Namespace('cart');
//        $cart->a=10;
//        $cart->b= [1,2,3,4,5];

        //echo  Zend_Registry::get('a');

//        $cart = new Zend_Session_Namespace('cart');
//        $cart->a=$this->_request->getParam('a');
//        $cart->b=$this->_request->getParam('b');
//        $cart->c=$this->_request->getParam('c');
        /***** Конец Передача данных *****/

        /**** Начало пагинации 1 ***/
        /*$mtime=microtime(true);

        $countries = new Application_Model_DbTable_Countries();
        //$paginator= new Zend_Paginator(new Zend_Paginator_Adapter_Array($countries->getCountriesByArray()));

        $paginator = new Zend_Paginator($countries->getCountriesByPaginatorAdapter());

        $paginator->setItemCountPerPage(10)
            ->setCurrentPageNumber($this->_request->getParam('page',1))
            ->setPageRange(11);
        $this->view->posts=$paginator;
        $this->view->start=$mtime;*/
        /**** Конец пагинации 1 ***/

        /**** Начало пагинации 2 ***/
       /* $mtime=microtime(true);

        $countries = new Application_Model_DbTable_Posts();
        //$paginator= new Zend_Paginator(new Zend_Paginator_Adapter_Array($countries->getCountriesByArray()));

        $paginator = new Zend_Paginator($countries->getPostsByPaginatorAdapter());

        $paginator->setItemCountPerPage(2)
            ->setCurrentPageNumber($this->_request->getParam('page',1))
            ->setPageRange(5);
        $this->view->posts=$paginator;
        $this->view->start=$mtime;*/
        /**** Конец пагинации 2 ***/

        /**** Начало форм ***/
//            $form = new Application_Form_Test();
//            $form->hidden->setValue('fuck');
//            if($this->_request->isPost() && $form->isValid($this->_request->getPost())){
//                $form->populate($this->_request->getPost());
//                //echo $form->getValue('text');
////                $a=$form->getValues();
////                print_r($a);
//                if($form->file->receive()){
//
//                }
//            }
//            $this->view->form=$form;
        /**** Конец форм ***/

        /***** Начало авторизации ****/
//            if(Zend_Auth::getInstance()->hasIdentity()){
//                echo "Авторизован\n";
//            }
//            else{
//                echo "Неавторизован\n";
//            }
//            $salt="!#%&() ";
//            $part1=substr($salt,0,3); //SUBSTRING(salt,1,3)
//            $part2=substr($salt,3); //SUBSTRING(salt,3)
//            $password="secret";
//            echo sha1(sha1($part1).$password.sha1($part2)); //SHA1(CONCAT(SHA1(SUBSTRING(salt,1,3)),?,SHA1(SUBSTRING(salt,3))))


        /**** Конец авторизации ****/

        /***** Начало логов ******/
        $writer= new Zend_Log_Writer_Stream('../logs/application.log');
        $logger = new Zend_Log($writer);

        $logger->log('Систма обрушилась',Zend_Log::EMERG);
        $logger->emerg('Система обрушилась');

        $logger->log('Нужно что-то исправить', Zend_Log::ALERT);
        $logger->alert('Нужно что-то');

        /***** Конец логов ******/

    }

    public function listAction()
    {
        // action body

        //echo $this->_request->getParam('genre');
        //echo $this->_request->getParam(1);
        //echo $this->_request->getParam('year');
    }

    public function loginAction()
    {

//        if(Zend_Auth::getInstance()->hasIdentity())
//            $this->_helper->redirector('index','index');
//
//        $authAdapter= new Zend_Auth_Adapter_DbTable();
//
//        $authAdapter->setTableName('users')
//            ->setIdentityColumn('username')
//            ->setCredentialColumn('password')
//           // ->setCredentialTreatment("SHA1(CONCAT(?,salt))");
//           ->setCredentialTreatment("SHA1(CONCAT(SHA1(SUBSTRING(salt,1,3)),?,SHA1(SUBSTRING(salt,4))))");
//
//
//
//        $authAdapter->setIdentity('admin')
//            ->setCredential('secret');
//
//        $auth=Zend_Auth::getInstance();
//        $result=$auth->authenticate($authAdapter);
//
//        if($result->isValid()){
//            echo 'OK';
//        }
//        else{
//            echo 'Not OK';
//        }
    }

    public function logoutAction()
    {
//        Zend_Auth::getInstance()->clearIdentity();
//            $this->_helper->redirector('index','index');

    }

    public function aAction()
    {
        // action body
    }

    public function bAction()
    {
        // action body
    }

    public function cAction()
    {
        // action body
    }

    public function dAction()
    {
        // action body
    }

    public function eAction()
    {
        // action body
    }



}

















