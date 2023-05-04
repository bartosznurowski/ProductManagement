<?php 

declare(strict_types=1);

namespace App\Models;

use PDO;

class Save extends Dbh 
{
    protected function setProduct(string $sku, string $name, int $price, string $category, array $attributes) 
    {
        $attribute = $this->setProductAttribute($category,$attributes);
        
        $stmt =$this->connect()->prepare('INSERT INTO product_list (`sku`,`name`,`price`,`attribute`) VALUES (?,?,?,?)');

        if (!$stmt->execute(array($sku,$name,$price,$attribute))) {
            $stmt=null;
            exit();
        }
        
        $stmt=null;
        exit('Product added');
    }

    protected function checkSku(string $sku) 
    {
        $stmt =$this->connect()->prepare('SELECT `sku` FROM product_list WHERE `sku`=?');

        if (!$stmt->execute(array($sku))) {
            $stmt=null;
            exit();
        }

        $resultCheck;
        if ($stmt->rowCount()>0) {
            $resultCheck=false;
        } else {
            $resultCheck=true;
        }

        return $resultCheck;
    }

    private function setProductAttribute(string $category, array $attributes) 
    {
        $stmt =$this->connect()->prepare('SELECT `attribute_category`,`attribute_unit` FROM product_category_attribute WHERE attribute_category=?');

        if (!$stmt->execute(array($category))) {
            $stmt=null;
            exit();
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $attributesConv= implode("x",$attributes);
        if (count($attributes)>1) {    
            $row['attribute_unit']=null;
        }

        $result = "{$row['attribute_category']}: $attributesConv {$row['attribute_unit']}";

        return $result;
    }
}