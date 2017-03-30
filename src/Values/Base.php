<?php
declare(strict_types=1);
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
abstract class Base implements Value
{
    /**
     * Test whether the object's primitive value is valid.
     */
    abstract protected static function validate($value): bool;

    /**
     * Return the message to be used when the constructor throws a
     * DomainException for an invalid value.
     */
    abstract protected static function invalidReason(): string;

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
    }

    public function isExceptional(): bool
    {
        return false;
    }

    public function value()
    {
        return $this->value;
    }

    /**
     * Convert the value to a string.
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }

    /**
     * @var \Ds\Map[] List of cached Value objects.
     */
    protected static $values;

    /**
     * Create a new Value object or retrieve it from the cache.
     *
     * @param mixed $value The internal primitive value.
     */
    public static function from($value): Value
    {
        if (!is_a($value, static::class) && !static::validate($value)) {
            return new ExceptionalValue($value, static::invalidReason());
        }

        return static::get($value);
    }

    protected static function get($value): Base
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
