<?php
    namespace Furniro\Model;

    class NewProductRequest {
        public ?string $productName = null;
        public ?string $desc = null;
        public ?int $price = null;
        public ?int $discountPrice = null;
        public ?int $category = null;
        public ?string $img = null;
    }