<?php

namespace  Controllers;

class AdminCategoryController
{

    public function index()
    {
        $categoriesList = Category::getCategoriesListAdmin();

        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    public function create()
    {

        foreach($_POST as $key=>$val){
            $val=strip_tags($val);
            $_POST[$key]=htmlspecialchars($val);
        }
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            $errors = false;

            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }


            if ($errors == false) {
                Category::createCategory($name, $sortOrder, $status);

                header("Location: /admin/category");
            }
        }

        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    public function update($id)
    {
        foreach($_POST as $key=>$val){
            $val=strip_tags($val);
            $_POST[$key]=htmlspecialchars($val);
        }
        $category = Category::getCategoryById($id);

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            Category::updateCategoryById($id, $name, $sortOrder, $status);

            header("Location: /admin/category");
        }

        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }


    public function delete($id)
    {

        if (isset($_POST['submit'])) {
            Category::deleteCategoryById($id);
            header("Location: /admin/category");
        }

        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }

}
