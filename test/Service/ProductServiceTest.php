<?php
    namespace Furniro\Service;

    use PHPUnit\Framework\TestCase;
    use Furniro\Repository\ProductRepository;
    use Furniro\Model\NewProductRequest;
    use Furniro\Config\Database;

    class ProductServiceTest extends TestCase {
        private ProductService $productService;
        private ProductRepository $productRepository;

        protected function setUp(): void {
            $this->productRepository = new ProductRepository(Database::getConnection());
            $this->productService = new ProductService($this->productRepository);

            $this->productRepository->deleteAll();
        }

        public function testCreateProductSuccess() {
            $request = new NewProductRequest();
            $request->productName = 'monitor';
            $request->desc = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat aut modi ullam, nisi necessitatibus accusamus. Optio atque provident quisquam quaerat?';
            $request->price = 120000;
            $request->discountPrice = null;
            $request->category = 1;
            $request->img = 'monitor';

            $response = $this->productService->createProduct($request);

            $this->assertEquals($response->product->productName, $request->productName);
            $this->assertEquals($response->product->desc, $request->desc);
            $this->assertEquals($response->product->price, $request->price);
            $this->assertEquals($response->product->discountPrice, $request->discountPrice);
            $this->assertEquals($response->product->category, $request->category);
            $this->assertEquals($response->product->img, $request->img);
        }

        public function testGetAllProductSuccess() {
            $request = new NewProductRequest();
            $request->productName = 'monitor';
            $request->desc = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat aut modi ullam, nisi necessitatibus accusamus. Optio atque provident quisquam quaerat?';
            $request->price = 120000;
            $request->discountPrice = null;
            $request->category = 1;
            $request->img = 'monitor';

            $request2 = new NewProductRequest();
            $request2->productName = 'monitor';
            $request2->desc = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat aut modi ullam, nisi necessitatibus accusamus. Optio atque provident quisquam quaerat?';
            $request2->price = 120000;
            $request2->discountPrice = 100000;
            $request2->category = 1;
            $request2->img = 'monitor';

            $this->productService->createProduct($request);
            $this->productService->createProduct($request2);

            $response = $this->productService->getAllProducts();
            $this->assertIsArray($response);
        }
    }