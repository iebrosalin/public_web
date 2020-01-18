<?php
declare(strict_types=1);

namespace Controllers;

use Components\Db\Db;
use Components\View\SimpleView;
use Exception;

/**
 * Class AdminController
 * @package Controllers
 */
class AdminController
{
    /**
     * @return bool|mixed
     */
    public function index()
    {
        $tables = Db::checkExistDb();

        if (empty($tables)) {
            try {
                Db::importDefaultDb();
            } catch (Exception $e) {
            }
            $tables = Db::checkExistDb();
        }

        $options = [
            "tables" => $tables
        ];

        return SimpleView::render('admin/index.php', $options);
    }
}
