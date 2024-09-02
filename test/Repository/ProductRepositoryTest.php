<?php
    namespace Furniro\Repository;

    use PHPUnit\Framework\TestCase;
    use Furniro\Config\Database;
    use Furniro\Domain\Product;
    
    class ProductRepositoryTest extends TestCase {
        private ProductRepository $productRepository;

        protected function setUp(): void {
            $this->productRepository = new ProductRepository(Database::getConnection());

            $this->productRepository->deleteAll();
        }

        public function testSaveSuccess() {
            $product = new Product();
            $product->id = uniqid();
            $product->productName = 'gaming table';
            $product->desc = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni soluta, hic odit ullam est unde consequatur nulla explicabo consequuntur molestias.';
            $product->price = 200.000;
            $product->discountPrice = 170.000;
            $product->category = 1;
            $product->img = 'table';

            $result = $this->productRepository->save($product);

            $this->assertEquals($result->id, $product->id);
            $this->assertEquals($result->productName, $product->productName);
            $this->assertEquals($result->desc, $product->desc);
            $this->assertEquals($result->price, $product->price);
            $this->assertEquals($result->discountPrice, $product->discountPrice);
            $this->assertEquals($result->category, $product->category);
            $this->assertEquals($result->img, $product->img);
        }

        public function testFindAllSuccess() {
            $product = new Product();
            $product->id = uniqid();
            $product->productName = 'gaming table';
            $product->desc = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni soluta, hic odit ullam est unde consequatur nulla explicabo consequuntur molestias.';
            $product->price = 200000;
            $product->discountPrice = 170000;
            $product->category = 1;
            $product->img = 'table';

            $product2 = new Product();
            $product2->id = uniqid();
            $product2->productName = 'gaming chair';
            $product2->desc = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni soluta, hic odit ullam est unde consequatur nulla explicabo consequuntur molestias.';
            $product2->price = 200000;
            $product2->discountPrice = 170000;
            $product2->category = 1;
            $product2->img = 'table';

            $this->productRepository->save($product);
            $this->productRepository->save($product2);

            $result = $this->productRepository->findAll();

            $this->assertIsArray($result);
        }

        public function testDeleteByIdSuccess() {
            $product = new Product();
            $product->id = uniqid();
            $product->productName = 'gaming table';
            $product->desc = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni soluta, hic odit ullam est unde consequatur nulla explicabo consequuntur molestias.';
            $product->price = 200.000;
            $product->discountPrice = 170.000;
            $product->category = 1;
            $product->img = 'table';

            $this->productRepository->save($product);
            $this->productRepository->deleteById($product->id);

            $result = $this->productRepository->findById($product->id);

            $this->assertNull($result);
        }

        public function testFindByIdNotFound() {
            $result = $this->productRepository->findById('not found');
            $this->assertNull($result);
        }
    }