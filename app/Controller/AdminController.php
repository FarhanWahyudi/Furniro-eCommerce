<?php
    namespace Furniro\Controller;

    use Furniro\App\View;

    class AdminController {
        public function dashboard() {
            View::render('Admin/dashboard', [
                'title' => 'Furniro | Dashboard',
                'style' => '/Styles/dashboard.css'
            ]);
        }
    }