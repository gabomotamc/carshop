<?php 
require __DIR__."/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use CoffeeCode\Router\Router;

if ( $_ENV['APP_ENV'] === 'dev' ) {
    $router = new Router($_ENV['URL_BASE_DEV']);
}

if ( $_ENV['APP_ENV'] === 'production' ) {
    $router = new Router($_ENV['URL_BASE_PRD']);
}  

# Not groups
$router->group(null);

$router->get("/", function ($data) {
    echo "<h1>Home</h1>";

    $data = ["realHttp" => $_SERVER["REQUEST_METHOD"]] + $data;
    echo "<h1>GET :: Welcome to {$_ENV['URL_BASE_DEV']} </h1>", "<pre>", print_r($data, true), "</pre>";
});

# Api V1 Routes
$router->group("api/v1/sellers")->namespace("controllers");
$router->get("/create", "SellerController:create");
$router->get("/get/{id}", "SellerController:get");
$router->get("/update", "SellerController:update");
$router->get("/delete/{id}", "SellerController:delete");

$router->dispatch();