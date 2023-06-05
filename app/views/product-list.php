<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="stylesheet" href="http://127.0.0.1/public/assets/css/product-list/style.css">
</head>

<body>
    
    <header>
        <h1>Product List</h1>
        <nav>
            <ul class="nav-buttons">
                <li><a href="add-product"><button>ADD</button></a></li>
                <li><button type="submit" form="products" name="submit" id="delete-product-btn">MASS DELETE</button></li>
            </ul>
        </nav>
    </header>

    <form action="app/controllers/delete-products" method="POST" id="products">

        <?php
            use App\Controllers\ProductController;
            
            include __DIR__."/../Autoloader.php";
            
            $product = new ProductController();
            $product->showProducts();
        ?>

    </form>      
    
    <footer>Inventory Management Project</footer>

</body>

</html>
