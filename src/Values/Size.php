<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

/**
 * Represents an image dimension, width or height.
 */
class Size extends Value
{
    /**
     * {@inheritDoc}
     *
     * A size is valid if it's an integer greater than or equal to 1.
     */
    protected function isValid(): bool
    {
        return is_int($this->value) && $this->value >= 1;
    }

    protected function invalidExceptionMesasge(): string
    {
        return 'Size value must be integer greater than or equal to 1';
    }

    /**
     * Add two Sizes and return the sum.
     *
     * @param self $other The other Size value to add.
     *
     * @return self The sum.
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
     *
     * @param self $other The other Size value to compare to.
     *
     * @return int -1, 0 or 1
     */
    public function compare(self $other): int
    {
        return $this->value <=> $other->value;
    }

    /**
     * Return the value doubled.
     *
     * @return self The doubled value.
     */
    public function double(): self
    {
        return new self($this->value * 2);
    }

    /**
     * Return the value halved.
     *
     * @return self The halved value.
     */
    public function half(): self
    {
        return new self((int) ceil($this->value / 2));
    }
}
