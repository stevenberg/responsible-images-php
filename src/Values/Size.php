<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Values;

use StevenBerg\WholesomeValues\Base;

/**
 * Represents an image dimension, width or height.
 */
class Size extends Base
{
    /**
     * Add two Sizes and return the sum.
     */
    public function add(self $other): self
    {
        return self::from($this->value + $other->value);
    }

    /**
     * Compare two Size values using the spaceship operator.
     *
     * Returns `-1` if `$other` is greater than `$this`, `0` if equal,
     * `1` if less than.
     */
    public function compare(self $other): int
    {
        return $this->value <=> $other->value;
    }

    /**
     * Return the value doubled.
     */
    public function double(): self
    {
        return self::from($this->value * 2);
    }

    /**
     * Return the value halved.
     */
    public function half(): self
    {
        return self::from((int) ceil($this->value / 2));
    }

    protected static function validate($value): bool
    {
        return is_int($value) && $value >= 1;
    }

    protected static function invalidReason(): string
    {
        return 'must be integer greater than or equal to 1';
    }
}
