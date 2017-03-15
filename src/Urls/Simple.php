<?php

namespace StevenBerg\ResponsiveImages\Urls;

use StevenBerg\ResponsiveImages\Values\Name;

class Simple implements Maker
{
    private $urlPrefix;

    public function __construct(string $urlPrefix)
    {
        $this->urlPrefix = $urlPrefix;
    }

    public function make(Name $name, array $options): string
    {
        return "$this->urlPrefix/" . $this->joinOptions($options) . "_$name";
    }

    private function joinOptions(array $options)
    {
        return implode('_', array_map(
            function ($k, $v) { return "$k-$v"; },
            array_keys($options),
            array_values($options)
        ));
    }
}
