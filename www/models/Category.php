<?php
declare(strict_types=1);

namespace Models;

use Components\Db\Db;
use PDO;

/**
 * Class Category
 * @package Models
 */
class Category
{
    /**
     * @return array
     */
    public static function getCategoriesListAdmin(): array
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC');

        $categoryList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * @param $id
     * @return bool
     */
    public static function deleteCategoryById($id): bool
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM category WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * @param int $id
     * @param string $name
     * @param int $sortOrder
     * @param int $status
     * @return bool
     */
    public static function updateCategoryById($id, string $name,  $sortOrder,  $status): bool
    {
        $db = Db::getConnection();

        $sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function getCategoryById( $id): array
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM category WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        return $result->fetch();
    }

    /**
     * @param $status
     * @return string
     */
    public static function getStatusText($status): string
    {
        if ($status == '1') {
            return 'Visible';
        }
        return 'Hidden';
    }

    /**
     * @param string $name
     * @param int $sortOrder
     * @param int $status
     * @return bool
     */
    public static function createCategory(string $name, $sortOrder, $status): bool
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO category (name, sort_order, status) '
                . 'VALUES (:name, :sort_order, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
}
