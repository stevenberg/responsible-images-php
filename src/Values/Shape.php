<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

use StevenBerg\ResponsibleImages\Square;
use StevenBerg\ResponsibleImages\Tall;
use StevenBerg\ResponsibleImages\Wide;
use StevenBerg\WholesomeValues\Base;

/**
 * Represents the shape of the resized images.
 *
 * - `original` leaves the original aspect ratio intact.
 * - `tall` is a rectangle twice as high as it is wide.
 * - `wide` is a rectangle twice as wide as it is high.
 */
class Shape extends Base
{
    const VALUES = ['original', 'square', 'tall', 'wide'];

    protected static function validate($value): bool
    {
        return is_string($value) && in_array($value, self::VALUES);
    }

    protected static function invalidReason(): string
    {
        return 'must be one of ' . implode(', ', self::VALUES);
    }
}
