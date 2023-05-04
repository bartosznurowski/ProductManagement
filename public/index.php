<?php

use App\Http\Router;
use App\Http\Request;

include "../app/Autoloader.php";

$router = new Router(new Request);

$router->get('/', function() {
    require __DIR__."/../app/views/product-list.php";
});

$router->get('/add-product', function() {
    require __DIR__."/../app/views/add-product.php";
});

$router->post('/app/controllers/delete-products', function() {
    require __DIR__."/../app/controllers/delete-products.php";
});

$router->post('/app/controllers/get-attributes', function() {
    require __DIR__."/../app/controllers/get-attributes.php";
});

$router->post('/app/views/add-product', function() {
    require __DIR__."/../app/views/add-product.php";
});