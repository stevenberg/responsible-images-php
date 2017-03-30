<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

class ExceptionalValue implements Value
{
    private $value;
    private $reason;

    public function __construct($value, string $reason)
    {
        $this->value = $value;
        $this->reason = $reason;
    }

    public function isExceptional(): bool
    {
        return true;
    }

    public function value()
    {
        return $this->value;
    }

    public function reason(): string
    {
        return $this->reason;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
