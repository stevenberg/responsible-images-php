<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Values;

/**
 * Represents the shape of the resized images.
 *
 * - `original` leaves the original aspect ratio intact.
 * - `tall` is a rectangle twice as high as it is wide.
 * - `wide` is a rectangle twice as wide as it is high.
 */
enum Shape: string implements Value
{
    case Original = 'original';

    case Square = 'square';

    case Tall = 'tall';

    case Wide = 'wide';

    public function getValue(): string
    {
        return $this->value;
    }
}
