<?php
    namespace Furniro\Controller;

    use Furniro\App\View;

    class ShopController {
        public function shop() {
            View::render('Shop/index', [
                'title' => 'Furniro | Shop',
                'style' => '/Styles/shop.css'
            ]);
        }
    }