<?php
declare(strict_types=1);
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
use StevenBerg\ResponsibleImages\Values\ExceptionalValue;
use StevenBerg\ResponsibleImages\Values\Shape;
use StevenBerg\ResponsibleImages\Wide;

class ShapeTest extends TestCase
{
    public function testNonStringValue()
    {
        $shape = Shape::from(1);

        $this->assertInstanceOf(ExceptionalValue::class, $shape);
    }

    public function testInvalidStringValue()
    {
        $shape = Shape::from('invalid');

        $this->assertInstanceOf(ExceptionalValue::class, $shape);
    }

    public function testValidValues()
    {
        $values = ['original', 'square', 'tall', 'wide'];

        foreach ($values as $value) {
            $shape = Shape::from($value);

            $this->assertEquals($value, (string) $shape);
        }
    }
}
