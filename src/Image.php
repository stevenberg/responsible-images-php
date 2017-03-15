<?php

namespace StevenBerg\ResponsiveImages;

use StevenBerg\ResponsiveImages\Urls\Maker;
use StevenBerg\ResponsiveImages\Values\Gravity;
use StevenBerg\ResponsiveImages\Values\Name;
use StevenBerg\ResponsiveImages\Values\Shape;
use StevenBerg\ResponsiveImages\Values\Size;

class Image
{
    protected $name;
    protected $gravity;
    protected $maker;

    public function __construct(Name $name, Gravity $gravity, Maker $maker)
    {
        $this->name = $name;
        $this->gravity = $gravity;
        $this->maker = $maker;
    }

    public function source(Size $size): string
    {
        return $this->maker->make($this->name, $this->options($size));
    }

    public function sourceSet(SizeRange $range): string
    {
        return implode(', ', array_map(
            function ($size) { return $this->source($size) . " {$size}w"; },
            $range->array()
        ));
    }

    public function tag(SizeRange $range, Size $defaultSize, array $attributes = []): string
    {
        $attributes['alt'] = $attributes['alt'] ?? '';
        $attributes['sizes'] = $attributes['sizes'] ?? '100vw';
        $attributes['src'] = $this->source($defaultSize);
        $attributes['srcset'] = $this->sourceSet($range);

        ksort($attributes);

        $attributeString = implode(' ', array_map(
            function ($key, $value) { return "$key='$value'"; },
            array_keys($attributes),
            array_values($attributes)
        ));

        return "<img $attributeString>";
    }

    protected function options(Size $size): array
    {
        return ['width' => $size];
    }

    public static function fromShape(Shape $shape, Name $name, Gravity $gravity, Maker $maker): self
    {
        switch ($shape) {
        case 'square':
             return new Square($name, $gravity, $maker);
        case 'tall':
            return new Tall($name, $gravity, $maker);
        case 'wide':
            return new Wide($name, $gravity, $maker);
        default:
            return new self($name, $gravity, $maker);
        }
    }
}
