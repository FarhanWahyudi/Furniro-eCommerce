<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Furniro\App\Router;
    use Furniro\Controller\HomeController;

    Router::add('GET', '/', HomeController::class, 'home' , []);

    Router::run();