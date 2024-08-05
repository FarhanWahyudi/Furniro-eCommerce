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

        public function register() {
            View::render('Auth/register', [
                'title' => 'Furniro | Register',
                'style' => '/Styles/register.css'
            ]);
        }
    }