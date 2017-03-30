<?php
declare(strict_types=1);
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages;

use StevenBerg\ResponsibleImages\Values\Gravity;
use StevenBerg\ResponsibleImages\Values\Size;

/**
 * Represents a responsive image twice as tall as it is wide.
 */
class Tall extends Image
{
    protected function options(Size $size): array
    {
        return [
            'width' => $size,
            'height' => $size->double(),
            'gravity' => $this->options['gravity'],
        ];
    }
}
