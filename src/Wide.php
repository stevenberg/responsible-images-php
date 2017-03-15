<?php

namespace StevenBerg\ResponsiveImages;

use StevenBerg\ResponsiveImages\Values\Size;

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
