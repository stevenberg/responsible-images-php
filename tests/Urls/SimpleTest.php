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
use StevenBerg\ResponsibleImages\Values\Size;

class SimpleTest extends TestCase
{
    protected Simple $maker;

    protected function setUp(): void
    {
        $this->maker = new Simple('https://example.com');
    }

    public function testMake(): void
    {
        $this->assertEquals(
            'https://example.com/width-100_test.jpg',
            $this->maker->make(
                'test.jpg',
                new Map(['width' => Size::from(100)]),
            ),
        );
    }
}
