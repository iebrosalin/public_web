<?php


namespace Controllers;


use Components\View\SimpleView;

class Errors
{
    public function error404()
    {
        if(false==SimpleView::render('errors/404.php'))
        {
            SimpleView::render('errors/500.php');
        }
        return true;
    }

}