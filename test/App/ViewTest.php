<?php
    namespace Furniro\App;

    use PHPUnit\Framework\TestCase;

    class ViewTest extends TestCase {
        public function testRender() {
            View::render(['Home/index', 'Home/test'], [
                'title' => 'home'
            ]);

            $this->expectOutputRegex('[home]');
            $this->expectOutputRegex('[testing]');
        }
    }