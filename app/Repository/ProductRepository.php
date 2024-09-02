<?php
    namespace Furniro\Repository;

    use Furniro\Domain\Product;
    use PDO;

    class ProductRepository {
        private \PDO $connection;

        public function __construct(\PDO $connection) {
            $this->connection = $connection;
        }

        public function save(Product $product): Product {
            $statement = $this->connection->prepare('INSERT INTO products (id, product_name, description, price, discount_price, category_id, product_img) VALUES (:id, :name, :desc, :price, :discount, :category, :img)');
            $statement->execute([
                ':id' => $product->id,
                ':name' => $product->productName,
                ':desc' => $product->desc,
                ':price' => $product->price,
                ':discount' => $product->discountPrice,
                ':category' => $product->category,
                ':img' => $product->img
            ]);
            return $product;
        }

        public function findById(string $id): ?Product {
            $statement = $this->connection->prepare('SELECT id, product_name, description, price, discount_price, category_id, product_img FROM products WHERE id = ?');
            $statement->execute([$id]);
            
            try {
                if ($row = $statement->fetch()) {
                    $product = new Product();
                    $product->id = $row['id'];
                    $product->productName = $row['product_name'];
                    $product->desc = $row['description'];
                    $product->price = $row['price'];
                    $product->discountPrice = $row['discount_price'];
                    $product->category = $row['category_id'];
                    $product->img = $row['product_img'];
                } else {
                    return null;
                }
            } finally {
                $statement->closeCursor();
            }
        }

        public function findAll(): array {
            $statement = $this->connection->prepare('SELECT id, product_name, description, price, discount_price, category_id, product_img FROM products');
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        }

        public function deleteById(string $id): void {
            $statement = $this->connection->prepare('DELETE FROM products WHERE id = ?');
            $statement->execute([$id]);
        }

        public function deleteAll(): void {
            $this->connection->exec('DELETE FROM products');
        }
    }