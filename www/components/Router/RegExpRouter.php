<?php

namespace Components\Router;

use Components\Interfaces\Router;
use Controllers\Error as Error;
use Exception;

class RegExpRouter implements Router
{

    private $routes;

    public function __construct()
    {
        $this->routes = include root().'/config/routes.php';
    }

    public function route()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $options=$this->extract($internalRoute);
                try {
                    if (false == @call_user_func_array(array(new $options['controller'], $options['action']), $options['param'])) {
                        call_user_func_array(array(new Error(), 'error404'), []);
                    }
                }  catch (Exception $error){
                    call_user_func_array(array(new Error(), 'error500'), [$error->getMessage()]);
                }
                break;
            }
        }
    }

    private function getURI(): string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    private function extract(string $url):array
    {
        $segments=explode('#',$url);
        $controller=$segments[0];

        $segments=explode('@',$segments[1]);
        $action=$segments[0];
        $param=(empty($segments[1]))?[]:[$segments[1]];

        return [
          'controller'=>$controller,
          'action'=>$action,
          'param' =>$param
        ];
    }

}
