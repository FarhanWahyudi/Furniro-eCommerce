<?php
    namespace Furniro\Model;

    class NewProductRequest {
        public ?string $productName;
        public ?string $desc;
        public ?int $price;
        public ?int $discountPrice;
        public ?int $category;
        public ?string $img;
    }