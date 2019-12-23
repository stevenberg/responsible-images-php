<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages;

use Ds\Map;
use StevenBerg\ResponsibleImages\Values\Size;

/**
 * Represents a responsive image twice as tall as it is wide.
 */
class Tall extends Image
{
    protected function options(Size $size): Map
    {
        return parent::options($size)->merge([
            'width' => $size,
            'height' => $size->double(),
        ]);
    }
}
