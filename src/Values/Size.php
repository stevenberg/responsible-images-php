<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

use StevenBerg\WholesomeValues\Base;

/**
 * Represents an image dimension, width or height.
 */
class Size extends Base
{
    protected static function validate($value): bool
    {
        return is_int($value) && $value >= 1;
    }

    protected static function invalidReason(): string
    {
        return 'must be integer greater than or equal to 1';
    }

    /**
     * Add two Sizes and return the sum.
     */
    public function add(self $other): self
    {
        return new self($this->value + $other->value);
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
        return new self($this->value * 2);
    }

    /**
     * Return the value halved.
     */
    public function half(): self
    {
        return new self((int) ceil($this->value / 2));
    }
}
