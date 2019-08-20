<?php

namespace Controllers;

use Components\View\SimpleView;
use Product;

class AdminProductController
{

    public function index()
    {
        $productsList = Product::getProductsList();

        return SimpleView::render('admin_product/index.php', [
            'productsList'=> $productsList
        ]);
    }

    public function create()
    {

        $categoriesList = Category::getCategoriesListAdmin();
        foreach($_POST as $key=>$val){
            $val=strip_tags($val);
            $_POST[$key]=htmlspecialchars($val);
        }
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {

                $id = Product::createProduct($options);

                if ($id) {
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                };

                header("Location: /admin/product");
            }
        }


        return SimpleView::render('admin_product/create.php',
            [
                'categoriesList'=>$categoriesList,
                'errors'=>$errors,
            ]);
    }

    public function update($id)
    {
        foreach($_POST as $key=>$val){
            $val=strip_tags($val);
            $_POST[$key]=htmlspecialchars($val);
        }

        $categoriesList = Category::getCategoriesListAdmin();

        $product = Product::getProductById($id);
        if (isset($_POST['submit'])) {
             $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            if (Product::updateProductById($id, $options)) {
            }

        }

        return  SimpleView::render('admin_product/update.php',
            [
                'categoriesList'=>$categoriesList,
                'product'=>$product,
            ]);
    }

    public function delete($id)
    {

        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);
            header("Location: /admin/product");
        }

        return SimpleView::render('admin_product/delete.php');
    }

}
