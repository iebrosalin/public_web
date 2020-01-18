<?php
declare(strict_types=1);


namespace Controllers;

use Components\Helpers\Helpers;
use Components\View\SimpleView;

/**
 * Class AdminEchoRequestController
 * @package Controllers
 */
class AdminEchoRequestController
{
    /**
     * @return bool|mixed
     */
    public function index()
    {
        return SimpleView::render('echo-request/index.php');
    }

    public function get()
    {
        foreach ($_GET as $k=>$v) {
            $_GET[$k]=Helpers::sanitize($v);
        }
        print_r($_GET);
        die();
    }

    public function post()
    {
        foreach ($_POST as $k=>$v) {
            $_POST[$k]=Helpers::sanitize($v);
        }
        print_r($_POST);
        die();
    }
}
