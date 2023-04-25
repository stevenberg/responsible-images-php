<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Values;

/**
 * Represents the location of focus when an image is cropped.
 *
 * `auto` lets the cropping/resizing service use some kind of
 * smart cropping algorithm if available, otherwise it just
 * does the default.
 */
enum Gravity: string implements Value
{
    case Auto = 'auto';

    case Center = 'center';

    public function getValue(): string
    {
        return $this->value;
    }
}
