<?php

namespace StevenBerg\ResponsiveImages\Values;

use DomainException;
use Ds\Map;

abstract class Value
{
    abstract protected function isValid();

    abstract protected function invalidExceptionMesasge();

    protected $value;

    protected function __construct($value)
    {
        $this->value = $value;

        if (!$this->isValid()) {
            throw new DomainException($this->invalidExceptionMesasge());
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static $values;

    public static function value($value): self
    {
        if (!isset(static::$values[static::class])) {
            static::$values[static::class] = new Map;
        }

        if (!static::$values[static::class]->hasKey($value)) {
            static::$values[static::class]->put($value, new static($value));
        }

        return static::$values[static::class]->get($value);
    }
}
