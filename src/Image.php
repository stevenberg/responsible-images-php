<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsiveImages;

use StevenBerg\ResponsiveImages\Urls\Maker;
use StevenBerg\ResponsiveImages\Values\Gravity;
use StevenBerg\ResponsiveImages\Values\Name;
use StevenBerg\ResponsiveImages\Values\Shape;
use StevenBerg\ResponsiveImages\Values\Size;

/**
 * Represents a responsive image.
 */
class Image
{
    /**
     * @var \StevenBerg\ResponsiveImages\Values\Name The image's name.
     */
    protected $name;

    /**
     * @var \StevenBerg\ResponsiveImages\Values\Gravity The gravity to use when cropping.
     */
    protected $gravity;

    /**
     * @var \StevenBerg\ResponsiveImages\Urls\Maker The class to use to generate resized image URLs.
     */
    protected $maker;

    /**
     * Constructor.
     *
     * @param \StevenBerg\ResponsiveImages\Values\Name $name The image's name.
     * @param \StevenBerg\ResponsiveImages\Values\Gravity The gravity to use when cropping.
     * @param \StevenBerg\ResponsiveImages\Urls\Maker The class to use to generate resized image URLs.
     */
    public function __construct(Name $name, Gravity $gravity, Maker $maker)
    {
        $this->name = $name;
        $this->gravity = $gravity;
        $this->maker = $maker;
    }

    /**
     * Return the URL for the image resized to the given width.
     *
     * @param \StevenBerg\ResponsiveImages\Values\Size $size The requested image width.
     *
     * @return string The URL of the resized image.
     */
    public function source(Size $size): string
    {
        return $this->maker->make($this->name, $this->options($size));
    }

    /**
     * Return the contents of a srcset attribute for the given range of widths.
     *
     * @param \StevenBerg\ResponsiveImages\SizeRange $range The requested range of widths.
     *
     * @return string The srcset.
     */
    public function sourceSet(SizeRange $range): string
    {
        return implode(', ', array_map(
            function ($size) { return $this->source($size) . " {$size}w"; },
            $range->array()
        ));
    }

    /**
     * Return a responsive HTML `img` tag for the image.
     *
     * @param \StevenBerg\ResponsiveImages\SizeRange $range The requested range of widths for the `srcset`.
     * @param \StevenBerg\ResponsiveImages\Values\Size $defaultSize The width to use for the `src`.
     * @param string[] $attributes List of attributes to add to the `img` tag.
     *
     * @return string The `img` tag.
     */
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

    /**
     * Return the list of options to pass to the URL maker class for an image of
     * the given width.
     *
     * @param \StevenBerg\ResponsiveImages\Values\Size $size The requested image width.
     *
     * @return (\StevenBerg\ResponsiveImages\Values\Value|string) The array of options.
     */
    protected function options(Size $size): array
    {
        return ['width' => $size];
    }

    /**
     * Return an `Image` object of the appropriate class based on
     * a `Shape` value.
     *
     * @param \StevenBerg\ResponsiveImages\Values\Shape $shape The requested image shape.
     * @param \StevenBerg\ResponsiveImages\Values\Name $name The image's name.
     * @param \StevenBerg\ResponsiveImages\Values\Gravity $gravity The gravity to use when cropping.
     * @param \StevenBerg\ResponsiveImages\Urls\Maker The class to use to generate resized image URLs.
     *
     * @return self
     */
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
