<?php

namespace Controllers;

use Components\View\SimpleView;

class AdminProductController
{

    public function actionIndex()
    {
        $productsList = Product::getProductsList();

        return SimpleView::render('admin_product/index.php', [
            'productsList'=> $productsList
        ]);
    }

    public function actionCreate()
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

        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    public function actionUpdate($id)
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
//                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
//
//                   move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
//                }
//                if (is_uploaded_file($_FILES["gallery"]["tmp_name"])) {
//                    $db=DB::getConnection();
//                    $sql = "INSERT INTO product_images (products_id,image) VALUE  (:products_id, :image)";
//                    $result = $db->prepare($sql);
//                    $result->bindParam(':products_id', $id, PDO::PARAM_INT);
//                    $result->bindParam(':image', $_FILES["gallery"]["name"], PDO::PARAM_STR);
//
//                    if ($result->execute()) {
//                        $PATHGALLERY="/upload/images/gallery/".$id."/";
//                        mkdir($_SERVER['DOCUMENT_ROOT'] . $PATHGALLERY,0777,false);
//                        move_uploaded_file($_FILES["gallery"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $PATHGALLERY.$_FILES["gallery"]["name"]);
//                    }
//
//                }
            }

        }


        return  SimpleView::render('admin_product/update.php',
            [
                'categoriesList'=>$categoriesList,
                'product'=>$product,
            ]);
    }

    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
      //  self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            Product::deleteProductById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/product");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

}
