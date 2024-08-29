<?php
    namespace Furniro\Model;

    class UserRegisterRequest {
        public ?string $id = null;
        public ?string $email = null;
        public ?string $password = null;
        public ?string $confirmPassword = null;
    }