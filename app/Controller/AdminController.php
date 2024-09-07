<?php
    namespace Furniro\Controller;

    use Furniro\App\View;
    use Furniro\Repository\ProductRepository;
    use Furniro\Service\ProductService;
    use Furniro\Config\Database;

    class AdminController {
        private ProductService $productService;

        public function __construct() {
            $productRepository = new ProductRepository(Database::getConnection());
            $this->productService = new ProductService($productRepository);
        }

        public function dashboard() {
            View::render('Admin/dashboard', [
                'title' => 'Furniro | Dashboard',
                'style' => '/Styles/dashboard.css'
            ]);
        }

        public function products() {
            $products = $this->productService->getAllProducts();

            View::render('/Admin/products', [
                'title' => 'Furniro | Products',
                'style' => '/Styles/products.css',
                'products' => $products
            ]);
        }

        public function deleteProduct() {
            $this->productService->deleteProduct($_GET['id']);
            $products = $this->productService->getAllProducts();

            View::render('/Admin/products', [
                'title' => 'Furniro | Products',
                'style' => '/Styles/products.css',
                'products' => $products
            ]);
        }
    }