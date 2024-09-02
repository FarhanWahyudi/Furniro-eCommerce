<?php
    namespace Furniro\Service;

    use Furniro\Repository\ProductRepository;
    use Furniro\Model\NewProductRequest;
    use Furniro\Model\NewProductResponse;
    use Furniro\Domain\Product;

    class ProductService {
        private ProductRepository $productRepository;

        public function __construct(ProductRepository $productRepository) {
            $this->productRepository = $productRepository;
        }

        public function createProduct(NewProductRequest $request): NewProductResponse {
            $product = new Product();
            $product->id = uniqid();
            $product->productName = $request->productName;
            $product->desc = $request->desc;
            $product->price = $request->price;
            $product->discountPrice = $request->discountPrice;
            $product->category = $request->category;
            $product->img = $request->img;

            $this->productRepository->save($product);

            $response = new NewProductResponse();
            $response->product = $product;
            return $response;
        }

        public function getAllProducts(): array {
            return $this->productRepository->findAll();
        }
    }