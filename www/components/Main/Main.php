<?php


namespace Components\Main;



use Components\Interfaces\Router;

class Main
{

    /**
     * @var Router
     */
    private $router;
//    public function  __construct( ...$dependency)
//    {
//        foreach ($dependency as $v)
//        {
//            $className=get_declared_interfaces($v);
//            if($className)
//            {
//                $className=mb_strtolower($className);
//                $this->$className=$v;
//            }
//            else
//                throw new \Exception("Допустимо передавать только объекты");
//
//        }
//        var_dump($className);
//    }


    public function __construct(Router $router)
    {
        $this->router=$router;
    }

    public function run(){
        $this->router->routed();
    }
}