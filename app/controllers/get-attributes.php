<?php

use App\Controllers\ProductController;

include __DIR__."/../Autoloader.php";

$attributeCategory = $_REQUEST['category'];

$product = new ProductController();
$product->showAttributes($attributeCategory);