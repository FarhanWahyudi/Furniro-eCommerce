<?php
    namespace Furniro\Middleware;

    interface Middleware {
        function before(): void;
    }