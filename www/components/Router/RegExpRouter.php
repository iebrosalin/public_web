<?php
declare(strict_types=1);

namespace Components\Router;

use Components\Interfaces\Router;
use Controllers\Error as Error;
use Exception;

/**
 * Class RegExpRouter
 *
 * @package Components\Router
 */
class RegExpRouter implements Router
{
    private $routes = [];

    /**
     * RegExpRouter constructor.
     */
    public function __construct()
    {
        $this->routes = include root().'/config/routes.php';
    }

    /**
     * @return mixed|void
     */
    public function route()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $options=$this->extract($internalRoute);
                try {
                    if(method_exists($options['controller'], $options['action'])){
                        call_user_func_array([$options['controller'], $options['action']], $options['param']);
                    } else {
                        call_user_func_array([new Error(), 'error404'], []);

                    }
                } catch (\Error $error) {
                    call_user_func_array([new Error(), 'error500'], [$error->getMessage()]);
                }
                break;
            }
        }
    }

    /**
     * @return string
     */
    private function getURI():string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }

        return '';
    }

    /**
     * @param  string $url
     * @return array
     */
    private function extract(string $url):array
    {
        $segments=explode('#', $url);
        $controller=$segments[0];

        $segments=explode('@', $segments[1]);
        $action=$segments[0];
        $param=(empty($segments[1]))?[]:[$segments[1]];

        return [
          'controller'=>$controller,
          'action'=>$action,
          'param' =>$param
        ];
    }
}
