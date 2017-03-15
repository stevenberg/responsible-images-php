<?php

namespace StevenBerg\ResponsiveImages;

use StevenBerg\ResponsiveImages\Values\Size;

class Square extends Image
{
    protected function options(Size $size): array
    {
        return [
            'width' => $size,
            'height' => $size,
            'gravity' => $this->gravity,
        ];
    }
}
