<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Tests;

use Ds\Vector;
use PHPUnit\Framework\TestCase;
use StevenBerg\ResponsibleImages\SizeRange;
use StevenBerg\ResponsibleImages\Values\Size;

class SizeRangeTest extends TestCase
{
    protected SizeRange $range;

    /** @var array<int, Size> */
    protected array $expected;

    protected function setUp(): void
    {
        $this->range = SizeRange::from(1, 10, 2);
        $this->expected = [
            Size::from(1),
            Size::from(3),
            Size::from(5),
            Size::from(7),
            Size::from(9),
        ];
    }

    public function testInvalidValues(): void
    {
        $range = SizeRange::from(10, 1, 1);

        self::assertEquals([], $range->toArray());
    }

    public function testSizes(): void
    {
        foreach ($this->range->sizes() as $i => $size) {
            self::assertEquals($this->expected[$i], $size);
        }
    }

    public function testArray(): void
    {
        self::assertEquals($this->expected, $this->range->toArray());
    }

    public function testToVector(): void
    {
        self::assertEquals(new Vector($this->expected), $this->range->toVector());
    }

    public function testFirst(): void
    {
        self::assertEquals(Size::from(1), $this->range->first());
    }

    public function last(): void
    {
        self::assertEquals(Size::from(9), $this->range->last());
    }
}
