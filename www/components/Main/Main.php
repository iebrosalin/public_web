<?php


namespace Components\Main;



use Components\Interfaces\Router;

class Main
{

    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router=$router;
    }

    public function run(){
        $this->router->route();
    }
}