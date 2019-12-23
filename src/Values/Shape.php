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
 * Represents the shape of the resized images.
 *
 * - `original` leaves the original aspect ratio intact.
 * - `tall` is a rectangle twice as high as it is wide.
 * - `wide` is a rectangle twice as wide as it is high.
 */
class Shape extends Enum
{
    private const Original = 'original';
    private const Square = 'square';
    private const Tall = 'tall';
    private const Wide = 'wide';
}
