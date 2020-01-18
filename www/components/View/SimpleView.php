<?php
declare(strict_types=1);


namespace Components\View;

use Components\Interfaces\View;

/**
 * Class SimpleView
 * @package Components\View
 */
class SimpleView implements View
{
    /**
     * @param string $path
     * @param array $options
     * @return bool|mixed
     */
    public static function render(string $path, array $options=[])
    {
        $pathToFile=view().'/'.$path;
        if (file_exists($pathToFile)) {
            include_once $pathToFile;
            return true;
        }
        return false;
    }
}
