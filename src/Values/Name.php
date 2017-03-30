<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

/**
 * Represents an image name.
 */
class Name extends Base
{
    /**
     * {@inheritDoc}
     *
     * A name is valid if it matches the regular expression
     * `/^[\w-]+(\/[\w-]+)*(\.(jpg|png))?$/i`.
     */
    protected static function validate($value): bool
    {
        return is_string($value) && strlen($value) >= 1;
    }

    protected static function invalidReason(): string
    {
        return 'Name value format must be string and valid format';
    }
}
