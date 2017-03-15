<?php

namespace StevenBerg\ResponsiveImages\Tests\Values;

use DomainException;
use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsiveImages\Square;
use StevenBerg\ResponsiveImages\Tall;
use StevenBerg\ResponsiveImages\Values\Shape;
use StevenBerg\ResponsiveImages\Wide;

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
