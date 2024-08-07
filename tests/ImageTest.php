<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Tests;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Image;
use StevenBerg\ResponsibleImages\SizeRange;
use StevenBerg\ResponsibleImages\Square;
use StevenBerg\ResponsibleImages\Tall;
use StevenBerg\ResponsibleImages\Urls\Simple;
use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\ResponsibleImages\Values\Shape;
use StevenBerg\ResponsibleImages\Values\Size;
use StevenBerg\ResponsibleImages\Wide;

class ImageTest extends TestCase
{
    protected Image $image;

    protected function setUp(): void
    {
        $this->image = new Image(
            'test.jpg',
            ['gravity' => Gravity::Auto],
            new Simple('https://example.com'),
        );
    }

    public function testToResponsiveImage(): void
    {
        self::assertSame($this->image, $this->image->toResponsiveImage());
    }

    public function testSource(): void
    {
        self::assertEquals(
            'https://example.com/gravity-auto_width-100_test.jpg',
            $this->image->source(Size::from(100)),
        );
    }

    public function testSourceSet(): void
    {
        $expected = implode(', ', [
            'https://example.com/gravity-auto_width-100_test.jpg 100w',
            'https://example.com/gravity-auto_width-200_test.jpg 200w',
            'https://example.com/gravity-auto_width-300_test.jpg 300w',
            'https://example.com/gravity-auto_width-400_test.jpg 400w',
            'https://example.com/gravity-auto_width-500_test.jpg 500w',
            'https://example.com/gravity-auto_width-600_test.jpg 600w',
            'https://example.com/gravity-auto_width-700_test.jpg 700w',
            'https://example.com/gravity-auto_width-800_test.jpg 800w',
            'https://example.com/gravity-auto_width-900_test.jpg 900w',
            'https://example.com/gravity-auto_width-1000_test.jpg 1000w',
        ]);

        $range = SizeRange::from(100, 1000, 100);

        self::assertEquals($expected, $this->image->sourceSet($range));
    }

    public function testTag(): void
    {
        $expected = "<img alt='Testy O&#039;Testerson' sizes='100vw' src='https://example.com/gravity-auto_width-100_test.jpg' srcset='https://example.com/gravity-auto_width-100_test.jpg 100w, https://example.com/gravity-auto_width-200_test.jpg 200w, https://example.com/gravity-auto_width-300_test.jpg 300w, https://example.com/gravity-auto_width-400_test.jpg 400w, https://example.com/gravity-auto_width-500_test.jpg 500w, https://example.com/gravity-auto_width-600_test.jpg 600w, https://example.com/gravity-auto_width-700_test.jpg 700w, https://example.com/gravity-auto_width-800_test.jpg 800w, https://example.com/gravity-auto_width-900_test.jpg 900w, https://example.com/gravity-auto_width-1000_test.jpg 1000w'>";

        $range = SizeRange::from(100, 1000, 100);
        $defaultSize = Size::from(100);
        $attributes = ['alt' => "Testy O'Testerson"];

        self::assertEquals($expected, $this->image->tag($range, $defaultSize, $attributes));
    }

    public function testFromShape(): void
    {
        $name = 'test.jpg';
        $maker = new Simple('https://exmaple.com');
        $options = ['gravity' => Gravity::Auto];

        $values = [
            [Shape::Original, Image::class],
            [Shape::Square, Square::class],
            [Shape::Tall, Tall::class],
            [Shape::Wide, Wide::class],
        ];

        foreach ($values as [$shape, $class]) {
            // @phpstan-ignore staticMethod.alreadyNarrowedType
            self::assertInstanceOf($class, Image::fromShape($shape, $name, $options, $maker));
        }
    }
}
