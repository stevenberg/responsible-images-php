<?php

namespace StevenBerg\ResponsiveImages\Values;

class Size extends Value
{
    protected function isValid(): bool
    {
        return is_int($this->value) && $this->value >= 1;
    }

    protected function invalidExceptionMesasge(): string
    {
        return 'Size value must be integer greater than or equal to 1';
    }

    public function add(self $other): self
    {
        return new self($this->value + $other->value);
    }

    public function compare(self $other): int
    {
        return $this->value <=> $other->value;
    }

    public function double(): self
    {
        return new self($this->value * 2);
    }

    public function half(): self
    {
        return new self((int) ceil($this->value / 2));
    }
}
