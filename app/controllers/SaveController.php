<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Save;

include __DIR__."/../Autoloader.php";

class SaveController extends Save 
{
    private string $sku;
    private string $name;
    private int $price;
    private string $category;
    private array $attributes;

    public function __construct(string $sku, string $name, int $price, string $category, array $attributes)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->attributes = $attributes;
    }

    public function saveProduct() 
    {
        if ($this->emptyInput() == false) {
            exit('Please, submit required data');
        }

        if ($this->invalidSku() == false) {
            exit('Please, provide the data of indicated type');
        }

        if ($this->invalidName() == false) {
            exit('Please, provide the data of indicated type');
        }

        if ($this->invalidPrice() == false) {
            exit('Please, provide the data of indicated type');
        }

        if ($this->invalidAttribute() == false) {
            exit('Please, provide the data of indicated type');
        }

        if ($this->skuTakenCheck() == false) {
            exit('SKU already taken');
        }
        
        $this->setProduct($this->sku,$this->name,$this->price,$this->category,$this->attributes);
    }

    private function emptyInput() 
    {
        $result;
        if(empty($this->sku) || empty($this->name) || empty($this->price) || empty($this->category) || empty($this->attributes)){
            $result=false;
        }else{
            $result=true;
        }
        
        return $result;
    }

    private function invalidSku() 
    {
        $result;
        if (preg_match("/[^a-zA-Z0-9-_]+/",$this->sku) || (strlen($this->sku)<8 || strlen($this->sku)>20)) {
            $result=false;
        } else {
            $result=true;
        }

        return $result;
    }

    private function skuTakenCheck() 
    {
        $result;
        if (!$this->checkSku($this->sku)) {
            $result=false;
        } else {
            $result=true;
        }

        return $result;
    }

    private function invalidName() 
    {
        $result;
        if (!preg_match("/^[a-zA-Z ]*$/",$this->name)) {
            $result=false;
        } else {
            $result=true;
        }

        return $result;
    }

    private function invalidPrice() 
    {
        $result;
        if ($this->price <= 0) {
            $result=false;
        } else {
            $result=true;
        }

        return $result;
    }

    private function invalidAttribute() 
    {
        $result;
        foreach ($this->attributes as $attribute) {
            if ($attribute <= 0) {
                $result=false;
                break;
            } else {
                $result=true;
            }
        }

        return $result;
    }
}