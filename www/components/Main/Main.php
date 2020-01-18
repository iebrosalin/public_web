<?php
declare(strict_types=1);


namespace Components\Main;

use Components\Interfaces\Router;

/**
 * Class Main
 * @package Components\Main
 */
class Main
{

    private Router $router;

    /**
     * Main constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router=$router;
    }

    public function run()
    {
        $this->router->route();
    }
}
