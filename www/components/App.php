<?php
declare(strict_types=1);


namespace Components;

use Components\Router\RegExpRouter;

/**
 * Class App
 * @package Components
 */
class App
{
    /**
     * run all project
     */
    public static function run()
    {
        putenv("ROOT_DIRECTORY=".dirname(__DIR__));
        $main =new Main\Main(new RegExpRouter());
        $main->run();
    }
}
