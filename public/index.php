<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Furniro\App\Router;
    use Furniro\Controller\HomeController;
    use Furniro\Controller\ShopController;

    // HOME
    Router::add('GET', '/', HomeController::class, 'home' , []);

    // SHOP
    Router::add('GET', '/shop', ShopController::class, 'shop', []);

    Router::run();