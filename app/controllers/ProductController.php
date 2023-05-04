<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;

include __DIR__."/../Autoloader.php";

class ProductController extends Product 
{
    public function showProducts() 
    {
        $products = $this->getProducts();
        
        foreach ($products as $product) {
            echo "
            <div class='product'>

                <div class='product-ins'> 

                    <div class='delete-checkbox-element'>
                        <input type='checkbox' class='delete-checkbox' name='deleteId[]' value='{$product['id']}'>
                    </div>

                    <div class='SKU'>
                        {$product['sku']}
                    </div>

                    <div class='name'>
                        {$product['name']}
                    </div>

                    <div class='price'>
                        {$product['price']} $
                    </div>

                    <div class='attribute'>
                        {$product['attribute']}
                    </div>

                </div>

            </div>";
        }
    }

    public function showCategories() 
    {
        $categories = $this->getCategories();
        
        foreach ($categories as $category) {
            $id = explode("-",$category['product']);
            echo "<option value='{$category['attribute_category']}' id='$id[0]'>{$category['product']}</option>";
        }
    }

    public function showAttributes(string $attributeCategory) 
    {
        $attributes = $this->getAttributes($attributeCategory);
        
        foreach ($attributes as $attribute) {
            echo "<br><label class='attribute-name'>".ucfirst($attribute['attribute'])." ({$attribute['attribute_unit']})</label><input type='number' name='attributes[]' id='{$attribute['attribute']}' />";
        }

        echo "<br><label class='description'><b>".$attribute["description"]."</b></label";
    } 

    public function deleteSelectedProducts(array $deleteId) 
    {
        $this->deleteProducts($deleteId);
    }
}