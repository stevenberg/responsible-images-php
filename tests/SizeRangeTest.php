<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */


namespace StevenBerg\ResponsibleImages\Tests;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\SizeRange;
use StevenBerg\ResponsibleImages\Values\Size;

class SizeRangeTest extends TestCase
{
    protected function setUp()
    {
        $this->range = SizeRange::from(1, 10, 2);
        $this->expected = [
            Size::value(1),
            Size::value(3),
            Size::value(5),
            Size::value(7),
            Size::value(9),
        ];
    }

    public function testInvalidValues()
    {
        $this->expectException(\DomainException::class);

        SizeRange::from(10, 1, 1);
    }

    public function testSizes()
    {
        foreach ($this->range->sizes() as $i => $size) {
            $this->assertEquals($this->expected[$i], $size);
        }
    }

    public function testArray()
    {
        $this->assertEquals($this->expected, $this->range->array());
    }

    public function testFirst()
    {
        $this->assertEquals(Size::value(1), $this->range->first());
    }

    public function last()
    {
        $this->assertEquals(Size::value(9), $this->range->last());
    }
}
