<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Tests\Values;

use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\WholesomeValues\ExceptionalValue;

class GravityTest extends TestCase
{
    public function testNonStringValue()
    {
        $gravity = Gravity::from(1);

        $this->assertInstanceOf(ExceptionalValue::class, $gravity);
    }

    public function testInvalidStringValue()
    {
        $gravity = Gravity::from('invalid');

        $this->assertInstanceOf(ExceptionalValue::class, $gravity);
    }

    public function testValidValues()
    {
        $values = ['auto', 'center'];

        foreach ($values as $value) {
            $shape = Gravity::from($value);

            $this->assertEquals($value, (string) $shape);
        }
    }
}
