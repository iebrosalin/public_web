<?php

namespace Controllers;

use Components\Db\Db;
use Components\View\SimpleView;

class AdminController
{

    public function index()
    {

        $tables = Db::checkExistDb();

        if(empty($tables)){
            Db::importDefaultDb();
            $tables = Db::checkExistDb();
        }

        $options = [
            "tables" => $tables
        ];

        return SimpleView::render('admin/index.php', $options);
    }

}
