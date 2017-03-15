<?php

namespace StevenBerg\ResponsiveImages\Tests\Urls;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsiveImages\Urls\Simple;
use StevenBerg\ResponsiveImages\Values\Name;
use StevenBerg\ResponsiveImages\Values\Size;

class SimpleTest extends TestCase
{
    protected function setUp()
    {
        $this->maker = new Simple('https://example.com');
    }

    public function test()
    {
        $this->assertEquals(
            'https://example.com/width-100_test.jpg',
            $this->maker->make(
                Name::value('test.jpg'),
                ['width' => Size::value(100)]
            )
        );
    }
}
