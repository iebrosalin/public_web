<?php


namespace Components\View;


use Components\App;
use Components\Interfaces\View;
use Exception;

class SimpleView implements View
{
    public static function render($path, $options=[])
    {
        $pathToFile=view().'/'.$path;
            if(file_exists($pathToFile)){
                require_once $pathToFile;
                return true;
            }
            else{
                return false;
            }

    }
}