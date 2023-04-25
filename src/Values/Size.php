<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Values;

/**
 * Represents an image dimension, width or height.
 */
class Size
{
    private $value;

    public function __construct(int $value)
    {
        if ($value <= 0) {
            throw new \TypeError('Argument 1 passed to StevenBerg\ResponsibleImages\Values\Size::__construct must be > 0');
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return strval($this->value);
    }

    public static function from(int $value): self
    {
        return new self($value);
    }

    public function getValue(): int
    {
        return $this->value;
    }

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
}
