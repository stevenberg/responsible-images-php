<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Tests;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\SizeRange;
use StevenBerg\ResponsibleImages\Urls\Simple;
use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\ResponsibleImages\Values\Size;
use StevenBerg\ResponsibleImages\Wide;

class WideTest extends TestCase
{
    protected Wide $image;

    protected function setUp(): void
    {
        $this->image = new Wide(
            'test.jpg',
            ['gravity' => Gravity::Center],
            new Simple('https://example.com'),
        );
    }

    public function testSource(): void
    {
        self::assertEquals(
            'https://example.com/gravity-center_height-50_width-100_test.jpg',
            $this->image->source(Size::from(100)),
        );
    }

    public function testSourceSet(): void
    {
        $expected = implode(', ', [
            'https://example.com/gravity-center_height-50_width-100_test.jpg 100w',
            'https://example.com/gravity-center_height-100_width-200_test.jpg 200w',
            'https://example.com/gravity-center_height-150_width-300_test.jpg 300w',
            'https://example.com/gravity-center_height-200_width-400_test.jpg 400w',
            'https://example.com/gravity-center_height-250_width-500_test.jpg 500w',
            'https://example.com/gravity-center_height-300_width-600_test.jpg 600w',
            'https://example.com/gravity-center_height-350_width-700_test.jpg 700w',
            'https://example.com/gravity-center_height-400_width-800_test.jpg 800w',
            'https://example.com/gravity-center_height-450_width-900_test.jpg 900w',
            'https://example.com/gravity-center_height-500_width-1000_test.jpg 1000w',
        ]);

        $range = SizeRange::from(100, 1000, 100);

        self::assertEquals($expected, $this->image->sourceSet($range));
    }
}
