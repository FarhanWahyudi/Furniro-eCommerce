<?php
    namespace Furniro\Controller;

    use Furniro\App\View;
    
    class AuthController {
        public function login() {
            View::render('Auth/login', [
                'title' => 'Furniro | Login',
                'style' => '/Styles/login.css'
            ]);
        }
    }