<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Tests;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Values\Size;

class SizeTest extends TestCase
{
    public function testZeroValue(): void
    {
        $this->expectException(\TypeError::class);

        $size = Size::from(0);
    }

    public function testNegativeValue(): void
    {
        $this->expectException(\TypeError::class);

        $size = Size::from(-1);
    }

    public function testStringConversion(): void
    {
        $size = Size::from(10);

        $this->assertEquals('10', (string) $size);
    }

    public function testCompare(): void
    {
        $size = Size::from(10);
        $less = Size::from(9);
        $equal = Size::from(10);
        $greater = Size::from(11);

        $this->assertEquals(-1, $size->compare($greater));
        $this->assertEquals(0, $size->compare($equal));
        $this->assertEquals(1, $size->compare($less));
    }

    public function testGetValue(): void
    {
        $size = Size::from(1);

        $this->assertSame(1, $size->getValue());
    }
}
