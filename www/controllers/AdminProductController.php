<?php
/** @noinspection DuplicatedCode */
declare(strict_types=1);

namespace Controllers;

use Components\Helpers\Helpers;
use Components\View\SimpleView;
use Models\Category;
use Models\Product;

/**
 * Class AdminProductController
 * @package Controllers
 */
class AdminProductController
{
    /**
     * @return bool|mixed
     */
    public function index()
    {
        $productsList = Product::getProductsList();

        return SimpleView::render('admin_product/index.php', [
            'productsList'=> $productsList
        ]);
    }

    /**
     * @return bool|mixed
     */
    public function create()
    {
        $categoriesList = Category::getCategoriesListAdmin();

        if (isset($_POST['submit'])) {
            foreach ($_POST as $key=>$val) {
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

            $errors = [];

            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if (empty($errors)) {
                $id = Product::createProduct($options);

                header("Location: /admin/product");
            }
        }


        return SimpleView::render(
            'admin_product/create.php',
            [
                'categoriesList'=>$categoriesList,
                'errors'=>$errors,
            ]
        );
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function update($id)
    {
        $categoriesList = Category::getCategoriesListAdmin();

        $product = Product::getProductById($id);
        if (isset($_POST['submit'])) {
            foreach ($_POST as $key=>$val) {
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
                header("Location: /admin/product");
            }
        }

        return  SimpleView::render(
            'admin_product/update.php',
            [
                'categoriesList'=>$categoriesList,
                'product'=>$product,
                'id'=>$id
            ]
        );
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete($id)
    {
        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);
            header("Location: /admin/product");
        }

        return SimpleView::render('admin_product/delete.php', ['id'=>$id]);
    }
}
