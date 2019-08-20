<?php

namespace Components\Router;

use Components\App;
use Components\Interfaces\Router;

class RegExpRouter implements Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = root() . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    public function routed()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $options=$this->extract($internalRoute);
                if (false==@call_user_func_array(array(new $options['controller'], $options['action']), $options['param'])) {
                    call_user_func_array(array(new \Controllers\Errors(), 'error404'),[]);
                }
                break;
            }
        }
    }

    private function extract(string $url):array
    {
        $segments=explode('#',$url);
        $controller=$segments[0];

        $segments=explode('@',$segments[1]);
        $action=$segments[0];
        $param=(empty($segments[1]))?null:$segments[1];

        return [
          'controller'=>$controller,
          'action'=>$action,
          'param' => []
        ];
    }

}
