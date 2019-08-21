<?php

namespace Controllers;

use Components\Helpers\Helpers;
use Components\View\SimpleView;
use Models\Category;
use Models\Product;

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

        if (isset($_POST['submit'])) {
            foreach($_POST as $key=>$val){
                $_POST[$key]=Helpers::sanitize($val);
            }
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['availability'] = empty($_POST['availability'])?0:1;
            $options['is_new'] =  empty($_POST['is_new'])?0:1;
            $options['is_recommended'] = empty($_POST['is_recommended'])?0:1;
            $options['status'] = empty($_POST['status'])?0:1;

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
        $categoriesList = Category::getCategoriesListAdmin();

        $product = Product::getProductById($id);
        if (isset($_POST['submit'])) {

            foreach($_POST as $key=>$val){
                $_POST[$key]=Helpers::sanitize($val);
            }
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['availability'] = empty($_POST['availability'])?0:1;
            $options['is_new'] =  empty($_POST['is_new'])?0:1;
            $options['is_recommended'] = empty($_POST['is_recommended'])?0:1;
            $options['status'] = empty($_POST['status'])?0:1;

            if (Product::updateProductById($id, $options)) {
                $product = Product::getProductById($id);

            }

        }

        return  SimpleView::render('admin_product/update.php',
            [
                'categoriesList'=>$categoriesList,
                'product'=>$product,
                'id'=>$id
            ]);
    }

    public function delete($id)
    {

        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);
            header("Location: /admin/product");
        }

        return SimpleView::render('admin_product/delete.php',['id'=>$id]);
    }

}
