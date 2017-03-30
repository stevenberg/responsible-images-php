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
use StevenBerg\ResponsibleImages\Values\Gravity;

class GravityTest extends TestCase
{
    public function testNonStringValue()
    {
        $this->expectException(DomainException::class);

        Gravity::from(1);
    }

    public function testInvalidStringValue()
    {
        $this->expectException(DomainException::class);

        Gravity::from('invalid');
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
