<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Tests;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\SizeRange;
use StevenBerg\ResponsibleImages\Square;
use StevenBerg\ResponsibleImages\Urls\Simple;
use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\ResponsibleImages\Values\Name;
use StevenBerg\ResponsibleImages\Values\Size;

class SquareTest extends TestCase
{
    protected function setUp()
    {
        $this->image = new Square(
            Name::value('test.jpg'),
            new Simple('https://example.com'),
            ['gravity' => Gravity::value('center')]
        );
    }

    public function testSource()
    {
        $this->assertEquals(
            'https://example.com/width-100_height-100_gravity-center_test.jpg',
            $this->image->source(Size::value(100))
        );
    }

    public function testSourceSet()
    {
        $expected = implode(', ', [
            'https://example.com/width-100_height-100_gravity-center_test.jpg 100w',
            'https://example.com/width-200_height-200_gravity-center_test.jpg 200w',
            'https://example.com/width-300_height-300_gravity-center_test.jpg 300w',
            'https://example.com/width-400_height-400_gravity-center_test.jpg 400w',
            'https://example.com/width-500_height-500_gravity-center_test.jpg 500w',
            'https://example.com/width-600_height-600_gravity-center_test.jpg 600w',
            'https://example.com/width-700_height-700_gravity-center_test.jpg 700w',
            'https://example.com/width-800_height-800_gravity-center_test.jpg 800w',
            'https://example.com/width-900_height-900_gravity-center_test.jpg 900w',
            'https://example.com/width-1000_height-1000_gravity-center_test.jpg 1000w',
        ]);

        $range = SizeRange::from(100, 1000, 100);

        $this->assertEquals($expected, $this->image->sourceSet($range));
    }
}
