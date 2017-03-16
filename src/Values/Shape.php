<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

use StevenBerg\ResponsibleImages\Square;
use StevenBerg\ResponsibleImages\Tall;
use StevenBerg\ResponsibleImages\Wide;

/**
 * Represents the shape of the resized images.
 *
 * - `original` leaves the original aspect ratio intact.
 * - `tall` is a rectangle twice as high as it is wide.
 * - `wide` is a rectangle twice as wide as it is high.
 */
class Shape extends Value
{
    const VALUES = ['original', 'square', 'tall', 'wide'];

    /**
     * {@inheritDoc}
     *
     * A shape value is valid if it's one of: `original`, `square`, `tall`,
     * `wide`.
     */
    protected function isValid(): bool
    {
        return is_string($this->value) && in_array($this->value, self::VALUES);
    }

    protected function invalidExceptionMesasge(): string
    {
        return 'Shape value must be one of ' . implode(', ', self::VALUES);
    }
}
