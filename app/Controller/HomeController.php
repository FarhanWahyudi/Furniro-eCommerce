<?php
    namespace Furniro\Controller;

    use Furniro\App\View;

    class HomeController {
        public function home() {
            View::render('Home/index', [
                'title' => 'Furniro | Home',
                'style' => '../Styles/home.css'
            ]);
        }
    }