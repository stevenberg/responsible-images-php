<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Tests\Urls;

use Ds\Map;
use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Urls\Simple;
use StevenBerg\ResponsibleImages\Values\Name;
use StevenBerg\ResponsibleImages\Values\Size;

class SimpleTest extends TestCase
{
    protected function setUp(): void
    {
        $this->maker = new Simple('https://example.com');
    }

    public function testMake()
    {
        $this->assertEquals(
            'https://example.com/width-100_test.jpg',
            $this->maker->make(
                Name::from('test.jpg'),
                new Map(['width' => Size::from(100)])
            )
        );
    }

    public function testMakeWithExceptionalValues()
    {
        $this->assertEquals(
            'https://example.com/height-100_test.jpg',
            $this->maker->make(
                Name::from('test.jpg'),
                new Map([
                    'width' => Size::from(0),
                    'height' => Size::from(100),
                ])
            )
        );
    }
}
