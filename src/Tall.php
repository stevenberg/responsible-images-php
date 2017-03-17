<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages;

use StevenBerg\ResponsibleImages\Urls\Maker;
use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\ResponsibleImages\Values\Name;
use StevenBerg\ResponsibleImages\Values\Size;

/**
 * Represents a responsive image twice as tall as it is wide.
 */
class Tall extends Image
{
    protected function options(Size $size): array
    {
        return [
            'width' => $size->value,
            'height' => $size->double()->value,
            'gravity' => $this->options['gravity']->value,
        ];
    }
}
