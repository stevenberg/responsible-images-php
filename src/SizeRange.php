<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages;

use Ds\Vector;
use Generator;
use StevenBerg\ResponsibleImages\Values\Size;

/**
 * Represents a range of Sizes with minimum and maximum values and an increment
 * value between elements.
 */
class SizeRange
{
    /**
     * @var Values\Size the minimum value in the range
     */
    private $min;

    /**
     * @var Values\Size the maximum value in the range
     */
    private $max;

    /**
     * @var Values\Size the increment between each value
     */
    private $step;

    /**
     * Constructor.
     */
    public function __construct(Size $min, Size $max, Size $step)
    {
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
    }

    /**
     * Make a new SizeRange from ints.
     */
    public static function from(int $min, int $max, int $step): self
    {
        return new self(Size::from($min), Size::from($max), Size::from($step));
    }

    /**
     * Generator function for iterating over the range.
     */
    public function sizes(): Generator
    {
        for ($s = clone $this->min; $s->compare($this->max) < 1; $s = $s->add($this->step)) {
            yield $s;
        }
    }

    /**
     * Convert the range to an array.
     */
    public function toArray(): array
    {
        return iterator_to_array($this->sizes());
    }

    public function toVector(): Vector
    {
        return new Vector($this->toArray());
    }

    /**
     * Return the first value in the range.
     */
    public function first(): Size
    {
        return $this->toVector()->first();
    }

    /**
     * Return the last value in the range.
     */
    public function last(): Size
    {
        return $this->toVector()->last();
    }
}
