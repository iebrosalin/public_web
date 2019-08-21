<?php

namespace  Controllers;

use Components\Helpers\Helpers;
use Components\View\SimpleView;
use Models\Category;

class AdminCategoryController
{

    public function index()
    {
        $categoriesList = Category::getCategoriesListAdmin();

        return SimpleView::render('admin_category/index.php',
            [
                'categoriesList'=>$categoriesList
            ]);
    }

    public function create()
    {

        if (isset($_POST['submit'])) {
            foreach($_POST as $key=>$val){
                $_POST[$key]=Helpers::sanitize($val);
            }
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = empty($_POST['status'])?0:1;

            $errors = false;

            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }


            if ($errors == false) {
                Category::createCategory($name, $sortOrder, $status);

                header("Location: /admin/category");
            }
        }

        return SimpleView::render('admin_category/create.php');
    }

    public function update($id)
    {

        $category = Category::getCategoryById($id);

        if (isset($_POST['submit'])) {
            foreach($_POST as $key=>$val){
                $_POST[$key]=Helpers::sanitize($val);
            }
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = empty($_POST['status'])?0:1;

            Category::updateCategoryById($id, $name, $sortOrder, $status);

            header("Location: /admin/category");
        }

        return  SimpleView::render('admin_category/update.php',
            [
                'id'=>$id,
                'category'=>$category,
            ]);
    }


    public function delete($id)
    {

        if (isset($_POST['submit'])) {
            Category::deleteCategoryById($id);
            header("Location: /admin/category");
        }


        return SimpleView::render('admin_category/delete.php',['id'=>$id]);
    }

}
