<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Tests;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Image;
use StevenBerg\ResponsibleImages\SizeRange;
use StevenBerg\ResponsibleImages\Square;
use StevenBerg\ResponsibleImages\Tall;
use StevenBerg\ResponsibleImages\Urls\Simple;
use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\ResponsibleImages\Values\Name;
use StevenBerg\ResponsibleImages\Values\Shape;
use StevenBerg\ResponsibleImages\Values\Size;
use StevenBerg\ResponsibleImages\Wide;

class ImageTest extends TestCase
{
    protected function setUp()
    {
        $this->image = new Image(
            Name::from('test.jpg'),
            ['gravity' => Gravity::from('auto')],
            new Simple('https://example.com')
        );
    }

    public function testSource()
    {
        $this->assertEquals(
            'https://example.com/width-100_test.jpg',
            $this->image->source(Size::from(100))
        );
    }

    public function testSourceSet()
    {
        $expected = implode(', ', [
            'https://example.com/width-100_test.jpg 100w',
            'https://example.com/width-200_test.jpg 200w',
            'https://example.com/width-300_test.jpg 300w',
            'https://example.com/width-400_test.jpg 400w',
            'https://example.com/width-500_test.jpg 500w',
            'https://example.com/width-600_test.jpg 600w',
            'https://example.com/width-700_test.jpg 700w',
            'https://example.com/width-800_test.jpg 800w',
            'https://example.com/width-900_test.jpg 900w',
            'https://example.com/width-1000_test.jpg 1000w',
        ]);

        $range = SizeRange::from(100, 1000, 100);

        $this->assertEquals($expected, $this->image->sourceSet($range));
    }

    public function testTag()
    {
        $expected = "<img alt='' sizes='100vw' src='https://example.com/width-100_test.jpg' srcset='https://example.com/width-100_test.jpg 100w, https://example.com/width-200_test.jpg 200w, https://example.com/width-300_test.jpg 300w, https://example.com/width-400_test.jpg 400w, https://example.com/width-500_test.jpg 500w, https://example.com/width-600_test.jpg 600w, https://example.com/width-700_test.jpg 700w, https://example.com/width-800_test.jpg 800w, https://example.com/width-900_test.jpg 900w, https://example.com/width-1000_test.jpg 1000w'>";

        $range = SizeRange::from(100, 1000, 100);
        $defaultSize = Size::from(100);

        $this->assertEquals($expected, $this->image->tag($range, $defaultSize));
    }

    public function testFromShape()
    {
        $name = Name::from('test.jpg');
        $maker = new Simple('https://exmaple.com');
        $options = ['gravity' => Gravity::from('auto')];

        $values = [
            'original' => Image::class,
            'square' => Square::class,
            'tall' => Tall::class,
            'wide' => Wide::class,
        ];

        foreach ($values as $value => $class) {
            $shape = Shape::from($value);

            $this->assertInstanceOf($class, Image::fromShape($shape, $name, $options, $maker));
        }
    }
}
