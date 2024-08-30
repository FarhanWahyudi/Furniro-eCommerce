<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Furniro\App\Router;
    use Furniro\Controller\HomeController;
    use Furniro\Controller\ShopController;
    use Furniro\Controller\AuthController;
    use Furniro\Middleware\MustLoginMiddleware;
    use Furniro\Middleware\MustNotLoginMiddleware;

    // HOME
    Router::add('GET', '/', HomeController::class, 'home' , []);

    // SHOP
    Router::add('GET', '/shop', ShopController::class, 'shop', [MustLoginMiddleware::class]);

    // AUTH
    Router::add('GET', '/login', AuthController::class, 'login', [MustNotLoginMiddleware::class]);
    Router::add('POST', '/login', AuthController::class, 'postLogin', [MustNotLoginMiddleware::class]);
    Router::add('GET', '/register', AuthController::class, 'register', [MustNotLoginMiddleware::class]);
    Router::add('POST', '/register', AuthController::class, 'postRegister', [MustNotLoginMiddleware::class]);
    Router::add('GET', '/logout', AuthController::class, 'logout', [MustLoginMiddleware::class]);

    Router::run();