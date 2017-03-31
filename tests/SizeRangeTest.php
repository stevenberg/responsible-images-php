<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Tests;

use Ds\Vector;
use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\SizeRange;
use StevenBerg\ResponsibleImages\Values\Size;

class SizeRangeTest extends TestCase
{
    protected function setUp()
    {
        $this->range = SizeRange::from(1, 10, 2);
        $this->expected = [
            Size::from(1),
            Size::from(3),
            Size::from(5),
            Size::from(7),
            Size::from(9),
        ];
    }

    public function testInvalidValues()
    {
        $range = SizeRange::from(10, 1, 1);

        $this->assertEquals([], $range->toArray());
    }

    public function testSizes()
    {
        foreach ($this->range->sizes() as $i => $size) {
            $this->assertEquals($this->expected[$i], $size);
        }
    }

    public function testArray()
    {
        $this->assertEquals($this->expected, $this->range->toArray());
    }

    public function testToVector()
    {
        $this->assertEquals(new Vector($this->expected), $this->range->toVector());
    }

    public function testFirst()
    {
        $this->assertEquals(Size::from(1), $this->range->first());
    }

    public function last()
    {
        $this->assertEquals(Size::from(9), $this->range->last());
    }
}
