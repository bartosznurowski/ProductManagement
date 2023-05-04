<?php 

declare(strict_types=1);

namespace App\Models;

use PDO;

class Product extends Dbh 
{
    protected function getCategories() 
    {
        $stmt = $this->connect()->prepare("SELECT * FROM product_category");

        if (!$stmt->execute()) {
            $stmt=null;
            exit();
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;

    }

    protected function getAttributes(string $attributeCategory) 
    {
        $stmt = $this->connect()->prepare("SELECT `attribute`,`attribute_unit`,`description` FROM product_category_attribute WHERE attribute_category=?");

        if (!$stmt->execute(array($attributeCategory))) {
            $stmt=null;
            exit();
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    protected function getProducts() 
    {
        $stmt = $this->connect()->prepare("SELECT * FROM product_list ORDER BY attribute DESC");

        if (!$stmt->execute()) {
            $stmt=null;
            exit();
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    protected function deleteProducts(array $deleteId) 
    {
        foreach ($deleteId as $id) {

            $stmt = $this->connect()->prepare("DELETE FROM product_list WHERE id=?");

            if (!$stmt->execute(array($id))) {
                $stmt=null;
                exit();
            }

            header("location: /");
        }
    }
}