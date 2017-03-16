<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages;

use DomainException;
use Generator;
use StevenBerg\ResponsibleImages\Values\Size;

class SizeRange
{
    private $min;
    private $max;
    private $step;

    public function __construct(Size $min, Size $max, Size $step)
    {
        if ($min->compare($max) >= 1) {
            throw new DomainException('SizeRange min must be less than max');
        }

        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
    }

    public static function from(int $min, int $max, int $step): self
    {
        return new self(Size::value($min), Size::value($max), Size::value($step));
    }

    public function sizes(): Generator
    {
        for ($s = clone $this->min; $s->compare($this->max) < 1; $s = $s->add($this->step)) {
            yield $s;
        }
    }

    public function array(): array
    {
        return iterator_to_array($this->sizes());
    }

    public function first(): Size
    {
        return $this->array()[0];
    }

    public function last(): Size
    {
        return array_reverse($this->array())[0];
    }
}
