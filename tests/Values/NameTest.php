<?php

namespace StevenBerg\ResponsiveImages\Tests\Values;

use DomainException;
use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsiveImages\Values\Name;

class NameTest extends TestCase
{
    public function testNonStringValue()
    {
        $this->expectException(DomainException::class);

        Name::value(1);
    }

    public function testValidStringValues()
    {
        $values = [
            'foo.jpg',
            'foo/bar.jpg',
            'foo-bar.jpg',
            'foo_bar.jpg',
            'foo42.jpg',
            'foo',
            'foo/bar',
            'foo-bar',
        ];

        foreach ($values as $value) {
            $name = Name::value($value);

            $this->assertEquals($value, (string) $name);
        }
    }

    public function testEmptyStringValue()
    {
        $this->expectException(DomainException::class);

        Name::value('');
    }

    public function testStringValueWithSpace()
    {
        $this->expectException(DomainException::class);

        Name::value('foo bar');
    }
}
