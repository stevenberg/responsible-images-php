<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Values;

use MyCLabs\Enum\Enum;

/**
 * Represents the location of focus when an image is cropped.
 *
 * `auto` lets the cropping/resizing service use some kind of
 * smart cropping algorithm if available, otherwise it just
 * does the default.
 */
class Gravity extends Enum
{
    private const Auto = 'auto';
    private const Center = 'center';
}
