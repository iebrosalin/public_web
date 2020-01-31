<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
//    protected function  _initDb(){
//        $config = [
//            'host'=>'localhost',
//            'username'=>'root',
//            'password'=> '',
//            'dbname'=>'zfdb',
//            'charset'=>'utf8',
//        ];
//        $db=Zend_Db::factory('Pdo_Mysql',$config);
//        Zend_Db_Table::setDefaultAdapter($db);
//    }
    protected function _initView()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        //$view->doctype('XHTML1_TRANSITIONAL');
        $view->doctype('XHTML1_STRICT');
        $view->headTitle('ZF1')->setSeparator('-');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8 ')
            ->appendName('author', 'MyName');
        $view->headLink()->appendStylesheet('/css/blueprint/screen.css', 'screen, projection')
            ->appendStylesheet('/css/blueprint/print.css', 'print')
            ->appendStylesheet('/css/blueprint/ie.css', 'screen, projection', 'IE');
        $view->headScript()->appendFile('/js/jquery/jquery.min.js');
        $view->headLink([
            'href' => 'favicon.ico', 'rel' => 'icon'
        ]);
    }

    protected function _initHelpers()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Application_View_Helper');
    }

//    protected  function  _initConfig()
//    {
//        $a=$this->getOption('a');
//        Zend_Registry::set('a',$a['b']);
//    }

//    protected  function  _initConfig()
//    {
//        $mult=$this->getOption('mult');
//        Zend_Registry::set('mult',$mult);
//    }
    /******* Статический роут ******/
//    protected function _initRouter()
//    {
//        $front=Zend_Controller_Front::getInstance();
//        $router=$front->getRouter();
//
//        $route= new Zend_Controller_Router_Route_Static(
//            'music',
//            [
//                'controller'=>'index',
//                'action'=>'list'
//            ]
//        );
//
//        $router->addRoute('music-route',$route);
//
//    }
    /******* Роут с параметром******/
//    protected function _initRouter()
//    {
//        $front=Zend_Controller_Front::getInstance();
//        $router=$front->getRouter();
//
//        $route= new Zend_Controller_Router_Route(
//            'music/:genre',
//            [
//                'controller'=>'index',
//                'action'=>'list',
//                'genre'=>'all',
//            ]
//        );
//
//        $router->addRoute('music-route',$route);
//
//    }
    /******* Роут с регуляркой******/
//    protected function _initRouter()
//    {
//        $front=Zend_Controller_Front::getInstance();
//        $router=$front->getRouter();
//
//        $route= new Zend_Controller_Router_Route_Regex(
//            'music(?:/(\d{4}))?',
//            [
//                'controller'=>'index',
//                'action'=>'list',
//                1=>2019,
//            ],
//            [
//                1=> 'year'
//            ]
//
//        );
//
//        $router->addRoute('music-route',$route);
//
//    }

    /******* Роут для поддоменов******/
//    protected function _initRouter()
//    {
//        $front=Zend_Controller_Front::getInstance();
//        $router=$front->getRouter();
//
//        $route= new Zend_Controller_Router_Route_Hostname(
//            'shop.'.$this->getOption('website'),
//            [
//                'controller'=>'index',
//                'action'=>'list',
//            ]
//        );
//
//        $router->addRoute('music-route',$route);
//
//    }

    /******* Объединённый роут 1******/
//    protected function _initRouter()
//    {
//        $front=Zend_Controller_Front::getInstance();
//        $router=$front->getRouter();
//
//        $route1= new Zend_Controller_Router_Route(
//            'news/:year',
//            [
//                'controller'=>'news',
//                'action'=>'year',
//            ]
//        );
//
//        $route2= new Zend_Controller_Router_Route(
//            ':month',
//            [
//                'controller'=>'news',
//                'action'=>'year-month',
//            ]
//        );
//
//        $route3 = new Zend_Controller_Router_Route(
//            ':day',
//            [
//                'controller'=>'news',
//                'action'=>'year-month-day',
//            ]
//        );
//
//        $router->addRoute('route3',$route1->chain($route2)->chain($route3))
//            ->addRoute('route2',$route1->chain($route2))
//            ->addRoute('route1',$route1);

//    }

//    /******* Роут с несколькими переменными******/
//    protected function _initRouter()
//    {
//        $front=Zend_Controller_Front::getInstance();
//        $router=$front->getRouter();
//
//        $route = new Zend_Controller_Router_Route(
//            'articles/:year/:month/:day',
//            [
//                'controller'=>'articles',
//                'action'=>'index',
//            ]
//        );
//
//
//        $router->addRoute('articles',$route);
//    }

    protected function _initCache()
    {

        $frontendOptions = [
            'lifetime' => 7200,
            'automatic_serialization' => true,
            'cache_by_default' => true,
            'non_cached_functions' => ['Application_Model_DbTable_Posts::addPost'],
        ];

        $backendoptions = [
            'cache_dir' => APPLICATION_PATH . '/../cache',
        ];
        $cache = Zend_Cache::factory('function', 'File', $frontendOptions, $backendoptions);
        Zend_Registry::set('cache', $cache);
    }

    protected function _initNavigation()
    {
       // $config=new Zend_Config_Xml(APPLICATION_PATH.'./configs/navigation.xml','nav');

//        $pages = [
//            [
//                'label' => 'Гавная',
//                'controller' => 'index',
//                'action' => 'index',
//            ],
//            [
//                'label' => 'Статьи',
//                'controller' => 'index',
//                'action' => 'index',
//                'pages' => [
//                    [
//                        'label' => 'Добавление статьи',
//                        'controller' => 'index',
//                        'action' => 'list',
//                    ],
//                    [
//                        'label' => 'Редактирование статьи',
//                        'controller' => 'index',
//                        'action' => 'index',
//                        'visible' => false,
//                    ],
//                    [
//                        'label' => 'Удаление статьи',
//                        'controller' => 'index',
//                        'action' => 'index',
//                        'visible' => false,
//                    ],
//                ],
//            ],
//            [
//                'label' => 'Другое',
//                'controller' => 'index',
//                'action' => 'index',
//                'pages' => [
//                    [
//                        'label' => 'Другое 1',
//                        'controller' => 'index',
//                        'action' => 'list',
//                    ],
//                    [
//                        'label' => 'Другое 2',
//                        'controller' => 'index',
//                        'action' => 'list',
//                    ],
//                    [
//                        'label' => 'Другое 3',
//                        'controller' => 'index',
//                        'action' => 'list',
//                    ],
//                ]
//
//            ]
//
//        ];

        $pages = [
            [
                'label' => 'Гавная',
                'controller' => 'index',
                'action' => 'index',
                'resource' => 'index',
                'privilege' => 'index',
            ],
            [
                'label' => 'A',
                'controller' => 'index',
                'action' => 'a',
                'resource' => 'index',
                'privilege' => 'a',
            ],
            [
                'label' => 'B',
                'controller' => 'index',
                'action' => 'b',
                'resource' => 'index',
                'privilege' => 'b',
            ],
            [
                'label' => 'C',
                'controller' => 'index',
                'action' => 'c',
                'resource' => 'index',
                'privilege' => 'c',
            ],
            [
                'label' => 'D',
                'controller' => 'index',
                'action' => 'd',
                'resource' => 'index',
                'privilege' => 'd',
            ],
            [
                'label' => 'E',
                'controller' => 'index',
                'action' => 'e',
                'resource' => 'index',
                'privilege' => 'e',
            ],

        ];
        //$navigation=new Zend_Navigation($config);
        $navigation=new Zend_Navigation($pages);

        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $view->navigation($navigation);
    }

    protected  function  _initAcl(){
        $acl= new Zend_Acl();

        $acl->addRole('guest');
        $acl->addRole('editor','guest');
        $acl->addRole('admin','editor');

        $acl->addResource('index');
        $acl->addResource('error');

//
//        $acl->allow('editor','index',['a','b','c']);
//
//        $acl->deny('guest','index');
//        $acl->deny('guest','index',['index']);
//        $acl->allow('guest','error');
//
//        $acl->allow('admin','index',['c','e']);
//        $acl->allow('admin','error');

        $acl->allow('guest','error');

        $acl->allow('guest','index',['index','a']);

        $acl->allow('guest','index',['b','c']);
        $acl->allow('guest','index',['d','e']);

        Zend_Registry::set('acl',$acl);

        Zend_Controller_Front::getInstance()
            ->registerPlugin(new Application_Plugin_Access());



    }
}

