<?php

declare(strict_types=1);

use App\Controllers\SaveController;

include __DIR__."/../Autoloader.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $sku = htmlspecialchars($_POST["sku"]);
    $name = htmlspecialchars($_POST["name"]);
    $price = intval($_POST["price"]);
    $category = htmlspecialchars($_POST["category"]);
    $attributes = $_POST["attributes"];

    $save = new SaveController($sku,$name,$price,$category,$attributes);
    $save->saveProduct();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Product Add</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="stylesheet" href="http://127.0.0.1/public/assets/css/add-product/style.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="public/assets/js/submit.js"></script>
    
</head>

<body>
    
    <header>
        <h1>Product Add</h1>
        <nav>
            <ul class="nav-buttons">
                <li><button type="submit" form="product_form" name="submit">Save</button></li>
                <li><a href="/"><button>Cancel</button></a></li>
            </ul>
        </nav>
    </header>

    <form action="add-product" method="post" id="product_form" autocomplete="off">

        <div id="form-message"></div>

        <label class="basic-field">SKU </label>
        <input type="text" name="sku" id="sku"/><br>
    
        <label class="basic-field">Name </label>
        <input type="text" name="name" id="name"/><br>
        
        <label class="basic-field">Price ($) </label>
        <input type="number" name="price" id="price"/><br>
        
        <label id="typeSwitcher" for="category">Type Switcher </label>
        <select id="productType" name="category" onchange="changeSpecificAttributes()">
            <option hidden selected></option>
            <?php
                use App\Controllers\ProductController;
                
                $product = new ProductController();
                $product->showCategories();
            ?>
        </select>

        <div id="productAttributes"></div>

    </form>

    <footer>Scandiweb Test assignment</footer>

</body>

</html>