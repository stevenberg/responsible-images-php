<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages;

use StevenBerg\ResponsibleImages\Values\Size;

class Wide extends Image
{
    protected function options(Size $size): array
    {
        return [
            'width' => $size,
            'height' => $size->half(),
            'gravity' => $this->gravity,
        ];
    }
}
