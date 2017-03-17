<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
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
            'width' => $size->value,
            'height' => $size->half()->value,
            'gravity' => $this->options['gravity']->value,
        ];
    }
}
