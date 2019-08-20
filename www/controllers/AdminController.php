<?php

namespace Controllers;

use Components\View\SimpleView;

class AdminController
{

    public function index()
    {
        return SimpleView::render('admin/index.php');
    }

}
