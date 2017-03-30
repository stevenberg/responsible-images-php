<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

/**
 * Represents the location of focus when an image is cropped.
 *
 * `auto` lets the cropping/resizing service use some kind of
 * smart cropping algorithm if available, otherwise it just
 * does the default.
 */
class Gravity extends Base
{
    const VALUES = ['auto', 'center'];

    /**
     * {@inheritDoc}
     *
     * A gravity value is valid if it's one of `auto`, `center`.
     */
    protected static function validate($value): bool
    {
        return is_string($value) && in_array($value, self::VALUES);
    }

    protected static function invalidReason(): string
    {
        return 'Gravity value must be one of ' . implode(', ', self::VALUES);
    }
}
