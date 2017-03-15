<?php

namespace StevenBerg\ResponsiveImages\Urls;

use StevenBerg\ResponsiveImages\Values\Name;

interface Maker
{
    public function make(Name $name, array $options): string;
}
