<?php
declare(strict_types=1);

namespace Models {

    use Components\Db\Db;
    use PDO;
    use PDOStatement;

    /**
     * Class Product
     *
     * @package Model
     */
    class Product
    {


        /**
         * Get Product by id
         *
         * @param  int $id
         * @return array
         */
        public static function getProductById(int $id): array
        {
            $db = Db::getConnection();

            $sql = 'SELECT * FROM product WHERE id = :id';

            $pdo = $db->prepare($sql);
            $pdo->bindParam(':id', $id, PDO::PARAM_INT);

            $pdo->setFetchMode(PDO::FETCH_ASSOC);

            $pdo->execute();

            return $pdo->fetch();
        }


        /**
         * Get product list
         *
         * @return array
         */
        public static function getProductsList(): array
        {
            $db = Db::getConnection();

            $pdo = $db->query('SELECT id, name, price, code, status FROM product ORDER BY id ASC');
            $productsList = [];
            $i = 0;
            while ($row = $pdo->fetch()) {
                $productsList[$i]['id'] = $row['id'];
                $productsList[$i]['name'] = $row['name'];
                $productsList[$i]['code'] = $row['code'];
                $productsList[$i]['price'] = $row['price'];
                $productsList[$i]['status'] = $row['status'];
                $i++;
            }
            return $productsList;
        }

        /**
         * @param  int $id
         * @return bool
         */
        public static function deleteProductById(int $id):bool
        {
            $db = Db::getConnection();

            $sql = 'DELETE FROM product WHERE id = :id';

            $pdo = $db->prepare($sql);
            $pdo->bindParam(':id', $id, PDO::PARAM_INT);
            return $pdo->execute();
        }


        /**
         * @param  int   $id
         * @param  array $options
         * @return bool
         */
        public static function updateProductById(int $id, array $options): bool
        {
            $db = Db::getConnection();

            $sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

            $pdo = $db->prepare($sql);
            $pdo->bindParam(':id', $id, PDO::PARAM_INT);
            self::prepareAllFields($pdo, $options);
            return $pdo->execute();
        }

        /**
         * @param  array $options
         * @return int
         */
        public static function createProduct(array $options): int
        {
            $db = Db::getConnection();

            $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recommended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recommended, :status)';

            $pdo = $db->prepare($sql);


            self::prepareAllFields($pdo, $options);
            if ($pdo->execute()) {
                return (int)$db->lastInsertId();
            }
            return 0;
        }

        /**
         * @param PDOStatement $pdo
         * @param array $options
         */
        private static function prepareAllFields(PDOStatement $pdo, array $options)
        {
            $pdo->bindParam(':name', $options['name'], PDO::PARAM_STR);
            $pdo->bindParam(':code', $options['code'], PDO::PARAM_STR);
            $pdo->bindParam(':price', $options['price'], PDO::PARAM_STR);
            $pdo->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
            $pdo->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
            $pdo->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
            $pdo->bindParam(':description', $options['description'], PDO::PARAM_STR);
            $pdo->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
            $pdo->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
            $pdo->bindParam(':status', $options['status'], PDO::PARAM_INT);
        }
    }
}
