<?php
declare(strict_types=1);
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Tests;

use DomainException;
use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Values\Size;

class SizeTest extends TestCase
{
    public function testNonIntValue()
    {
        $this->expectException(DomainException::class);

        Size::from('invalid');
    }

    public function testZeroValue()
    {
        $this->expectException(DomainException::class);

        Size::from(0);
    }

    public function testNegativeValue()
    {
        $this->expectException(DomainException::class);

        Size::from(-1);
    }

    public function testStringConversion()
    {
        $size = Size::from(10);

        $this->assertEquals('10', (string) $size);
    }

    public function testCompare()
    {
        $size = Size::from(10);
        $less = Size::from(9);
        $equal = Size::from(10);
        $greater = Size::from(11);

        $this->assertEquals(-1, $size->compare($greater));
        $this->assertEquals(0, $size->compare($equal));
        $this->assertEquals(1, $size->compare($less));
    }
}
