<?php

use App\Controllers\ProductController;

include __DIR__."/../Autoloader.php";

if (isset($_POST["deleteId"])) {
    
    $deleteId = $_POST["deleteId"];

    $product = new ProductController();
    $product->deleteSelectedProducts($deleteId);
    
} else {
    header("Location: /");
}