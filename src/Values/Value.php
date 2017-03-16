<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

use DomainException;
use Ds\Map;

/**
 * Abstract class for domain-model value types that wrap primitive values.
 */
abstract class Value
{
    /**
     * Test whether the object's primitive value is valid.
     *
     * @return bool
     */
    abstract protected function isValid(): bool;

    /**
     * Return the message to be used when the constructor throws a
     * DomainException for an invalid value.
     *
     * @return string
     */
    abstract protected function invalidExceptionMesasge(): string;

    /**
     * @var mixed The internal primitive value
     */
    protected $value;

    /**
     * Constructor.
     *
     * Value objects can't be instantiated directly with `new`. Instead, create
     * new objects with the `value` static method.
     *
     * @param mixed $value The internal primitive value.
     *
     * @throws DomainException if the provided value is invalid.
     */
    protected function __construct($value)
    {
        $this->value = $value;

        if (!$this->isValid()) {
            throw new DomainException($this->invalidExceptionMesasge());
        }
    }

    /**
     * Return overloaded properties.
     *
     * - `value` is the underlying internal value.
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if ($name === 'value') {
            return $this->value;
        }
    }

    /**
     * Convert the value to a string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @var \Ds\Map[] List of cached Value objects.
     */
    protected static $values;

    /**
     * Create a new Value object or retrieve it from the cache.
     *
     * @param mixed $value The internal primitive value.
     *
     * @return self
     */
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
