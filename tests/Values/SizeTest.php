<?php

namespace StevenBerg\ResponsiveImages\Tests;

use DomainException;
use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsiveImages\Values\Size;

class SizeTest extends TestCase
{
    public function testNonIntValue()
    {
        $this->expectException(DomainException::class);

        Size::value('invalid');
    }

    public function testZeroValue()
    {
        $this->expectException(DomainException::class);

        Size::value(0);
    }

    public function testNegativeValue()
    {
        $this->expectException(DomainException::class);

        Size::value(-1);
    }

    public function testStringConversion()
    {
        $size = Size::value(10);

        $this->assertEquals('10', (string) $size);
    }

    public function testCompare()
    {
        $size = Size::value(10);
        $less = Size::value(9);
        $equal = Size::value(10);
        $greater = Size::value(11);

        $this->assertEquals(-1, $size->compare($greater));
        $this->assertEquals(0, $size->compare($equal));
        $this->assertEquals(1, $size->compare($less));
    }
}