<?php
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
class Gravity extends Value
{
    const VALUES = ['auto', 'center'];

    /**
     * {@inheritDoc}
     *
     * A gravity value is valid if it's one of `auto`, `center`.
     */
    protected function isValid(): bool
    {
        return is_string($this->value) && in_array($this->value, self::VALUES);
    }

    protected function invalidExceptionMesasge(): string
    {
        return 'Gravity value must be one of ' . implode(', ', self::VALUES);
    }
}
