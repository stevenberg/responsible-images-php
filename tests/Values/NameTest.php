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
use StevenBerg\ResponsibleImages\Values\ExceptionalValue;
use StevenBerg\ResponsibleImages\Values\Name;

class NameTest extends TestCase
{
    public function testNonStringValue()
    {
        $name = Name::from(1);

        $this->assertInstanceOf(ExceptionalValue::class, $name);
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
        $name = Name::from('');

        $this->assertInstanceOf(ExceptionalValue::class, $name);
    }
}
