<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages;

use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\ResponsibleImages\Values\Size;

/**
 * Represents a responsive image twice as wide as it is tall.
 */
class Wide extends Image
{
    protected function options(Size $size): array
    {
        return [
            'width' => $size,
            'height' => $size->half(),
            'gravity' => $this->options['gravity'],
        ];
    }
}
