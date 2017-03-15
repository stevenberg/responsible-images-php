<?php

namespace StevenBerg\ResponsiveImages;

use StevenBerg\ResponsiveImages\Values\Size;

class Tall extends Image
{
    protected function options(Size $size): array
    {
        return [
            'width' => $size,
            'height' => $size->double(),
            'gravity' => $this->gravity,
        ];
    }
}
