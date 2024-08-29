<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Furniro\App\Router;
    use Furniro\Controller\HomeController;
    use Furniro\Controller\ShopController;
    use Furniro\Controller\AuthController;

    // HOME
    Router::add('GET', '/', HomeController::class, 'home' , []);

    // SHOP
    Router::add('GET', '/shop', ShopController::class, 'shop', []);

    // AUTH
    Router::add('GET', '/login', AuthController::class, 'login', []);
    Router::add('POST', '/login', AuthController::class, 'postLogin', []);
    Router::add('GET', '/register', AuthController::class, 'register', []);
    Router::add('POST', '/register', AuthController::class, 'postRegister', []);
    Router::add('GET', '/logout', AuthController::class, 'logout', []);

    Router::run();