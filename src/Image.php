<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages;

use Ds\Map;
use StevenBerg\ResponsibleImages\Urls\Maker;
use StevenBerg\ResponsibleImages\Values\Name;
use StevenBerg\ResponsibleImages\Values\Shape;
use StevenBerg\ResponsibleImages\Values\Size;

/**
 * Represents a responsive image.
 */
class Image
{
    /**
     * @var Values\Name The image's name.
     */
    protected $name;

    /**
     * @var Values\Value[] Options to pass to the URL maker.
     */
    protected $options;

    /**
     * @var Maker The class to use to generate resized image URLs.
     */
    protected $maker;

    /**
     * Constructor.
     *
     * @param Values\Value[] $options Options to pass to the URL maker class.
     */
    public function __construct(Name $name, array $options = [], Maker $maker = null)
    {
        $this->name = $name;
        $this->options = new Map($options);
        $this->maker = $maker;
    }

    /**
     * Return the URL for the image resized to the given width.
     */
    public function source(Size $size): string
    {
        return $this->maker()->make($this->name, $this->options($size));
    }

    /**
     * Return the contents of a srcset attribute for the given range of widths.
     */
    public function sourceSet(SizeRange $range): string
    {
        return $range->toVector()
            ->map(function ($size) {
                return $this->source($size) . " {$size}w";
            })
            ->join(', ');
    }

    /**
     * Return a responsive HTML `img` tag for the image.
     *
     * @param string[] $attributes List of attributes to add to the `img` tag.
     */
    public function tag(SizeRange $range, Size $defaultSize, array $attributes = []): string
    {
        $attributes = new Map($attributes);
        $attributes['alt'] = isset($attributes['alt']) ? $attributes['alt'] : '';
        $attributes['sizes'] = isset($attributes['sizes']) ? $attributes['sizes'] : '100vw';
        $attributes['src'] = $this->source($defaultSize);
        $attributes['srcset'] = $this->sourceSet($range);

        $attributeString = $attributes
            ->ksorted()
            ->map(function ($key, $value) {
                return "$key='$value'";
            })
            ->values()
            ->join(' ');

        return "<img $attributeString>";
    }

    /**
     * Return the list of options to pass to the URL maker class for an image of
     * the given width.
     */
    protected function options(Size $size): array
    {
        return ['width' => $size];
    }

    private function maker(): Maker
    {
        return $this->maker ?? Maker::defaultMaker();
    }

    /**
     * Return an `Image` object of the appropriate class based on
     * a `Shape` value.
     *
     * @param Values\Value[] $options Options to pass to the URL maker class.
     */
    public static function fromShape(
        Shape $shape,
        Name $name,
        array $options = [],
        Maker $maker = null
    ): self {
        switch ($shape) {
            case 'square':
                return new Square($name, $options, $maker);
            case 'tall':
                return new Tall($name, $options, $maker);
            case 'wide':
                return new Wide($name, $options, $maker);
            default:
                return new self($name, $options, $maker);
        }
    }
}
