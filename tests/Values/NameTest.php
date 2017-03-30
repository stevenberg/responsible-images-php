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
use StevenBerg\ResponsibleImages\Values\Name;

class NameTest extends TestCase
{
    public function testNonStringValue()
    {
        $this->expectException(DomainException::class);

        Name::from(1);
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
            $name = Name::from($value);

            $this->assertEquals($value, (string) $name);
        }
    }

    public function testEmptyStringValue()
    {
        $this->expectException(DomainException::class);

        Name::from('');
    }

    public function testStringValueWithSpace()
    {
        $this->expectException(DomainException::class);

        Name::from('foo bar');
    }
}
