<?php
    namespace Furniro\Domain;

    class Product {
        public string $id;
        public string $productName;
        public string $desc;
        public int $price;
        public int $discountPrice;
        public int $category;
        public string $img;
    }