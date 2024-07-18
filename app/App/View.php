<?php
    namespace Furniro\App;

    class View {
        public static function render(array $views, $model) {
            require_once __DIR__ . '/../View/header.php';
            foreach($views as $view) {
                require_once __DIR__ . '/../View/' . $view . '.php';
            }
            require_once __DIR__ . '/../View/footer.php';
        }


        public static function redirect(string $url) {
            header("Location: $url");
            if (getenv('mode') != 'test') {
                exit();
            }
        }
    }