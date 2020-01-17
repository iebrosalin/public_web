<?php


namespace Controllers;


use Components\View\SimpleView;

class Error
{
    public function error404()
    {
        SimpleView::render('errors/404.php');
    }

    public function error500(string $message)
    {
        $options = [
            "message" => $message
        ];
        SimpleView::render('errors/500.php', $options);
    }
}