<?php


namespace Components;


use Components\Router\RegExpRouter;

class App
{
    private static $app;

    public static function run()
    {
        putenv("ROOT_DIRECTORY=".dirname(__DIR__));
        self::$app=new Main\Main(new RegExpRouter());
        self::$app->run();
    }

}