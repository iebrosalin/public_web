<?php
declare(strict_types=1);


namespace Controllers;

use Components\View\SimpleView;

/**
 * Class Error
 * @package Controllers
 */
class Error
{
    public static function error404()
    {
        SimpleView::render('errors/404.php');
    }

    /**
     * @param string $message
     */
    public static function error500(string $message)
    {
        $options = [
            "message" => $message
        ];
        SimpleView::render('errors/500.php', $options);
    }
}
