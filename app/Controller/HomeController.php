<?php
    namespace Furniro\Controller;

    use Furniro\App\View;
    use Furniro\Repository\ProductRepository;
    use Furniro\Service\ProductService;
    use Furniro\Config\Database;

    class HomeController {
        private ProductService $productService;
        private ProductRepository $productRepository;

        public function __construct() {
            $this->productRepository = new ProductRepository(Database::getConnection());
            $this->productService = new ProductService($this->productRepository);
        }

        public function home() {
            $products = $this->productService->getAllProducts();

            View::render('Home/index', [
                'title' => 'Furniro | Home',
                'style' => '../Styles/home.css',
                'products' => $products
            ]);
        }
    }