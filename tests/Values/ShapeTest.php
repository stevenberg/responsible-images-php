<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */


namespace StevenBerg\ResponsibleImages\Tests\Values;

use DomainException;
use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Square;
use StevenBerg\ResponsibleImages\Tall;
use StevenBerg\ResponsibleImages\Values\Shape;
use StevenBerg\ResponsibleImages\Wide;

class ShapeTest extends TestCase
{
    public function testNonStringValue()
    {
        $this->expectException(DomainException::class);

        Shape::value(1);
    }

    public function testInvalidStringValue()
    {
        $this->expectException(DomainException::class);

        Shape::value('invalid');
    }

    public function testValidValues()
    {
        $values = ['original', 'square', 'tall', 'wide'];

        foreach ($values as $value) {
            $shape = Shape::value($value);

            $this->assertEquals($value, (string) $shape);
        }
    }
}
