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

class Square extends Image
{
    /* public function __construct(Name $name, Maker $maker, array $options = []) */
    /* { */
    /*     parent::__construct($name, $maker, $options); */

    /*     if (!isset($this->options['gravity'])) { */
    /*         $this->options['gravity'] = Gravity::value('auto'); */
    /*     } */
    /* } */

    protected function options(Size $size): array
    {
        return [
            'width' => $size->value,
            'height' => $size->value,
            'gravity' => $this->options['gravity']->value,
        ];
    }
}
