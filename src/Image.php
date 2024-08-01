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
use StevenBerg\ResponsibleImages\Values\Shape;
use StevenBerg\ResponsibleImages\Values\Size;

/**
 * Represents a responsive image.
 */
class Image implements ResponsiveImageable
{
    /**
     * @var string the image's name
     */
    protected string $name;

    /**
     * @var Map<string, OptionType> options to pass to the URL maker
     */
    protected Map $options;

    /**
     * @var ?Maker the class to use to generate resized image URLs
     */
    protected ?Maker $maker;

    /**
     * Constructor.
     *
     * @param  array<string, OptionType>  $options  options to pass to the URL maker class
     */
    public function __construct(string $name, array $options = [], ?Maker $maker = null)
    {
        $this->name = $name;
        $this->options = new Map($options);
        $this->maker = $maker;
    }

    /**
     * {@inheritdoc}
     */
    public function toResponsiveImage(): self
    {
        return $this;
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
            ->join(', ')
        ;
    }

    /**
     * Return a responsive HTML `img` tag for the image.
     *
     * @param  string[]  $attributes  list of attributes to add to the `img` tag
     */
    public function tag(SizeRange $range, Size $defaultSize, array $attributes = []): string
    {
        $attributes = new Map($attributes);
        $attributes['alt'] ??= '';
        $attributes['sizes'] ??= '100vw';
        $attributes['src'] = $this->source($defaultSize);
        $attributes['srcset'] = $this->sourceSet($range);

        $attributeString = $attributes
            ->ksorted()
            ->map(function (string $key, $value): string {
                return "{$key}='" . htmlspecialchars($value, ENT_QUOTES) . "'";
            })
            ->values()
            ->join(' ')
        ;

        return "<img {$attributeString}>";
    }

    /**
     * Return an `Image` object of the appropriate class based on
     * a `Shape` value.
     *
     * @param  array<string, OptionType>  $options  options to pass to the URL maker class
     */
    public static function fromShape(
        Shape $shape,
        string $name,
        array $options = [],
        Maker $maker = null,
    ): self {
        return match ($shape) {
            Shape::Original => new self($name, $options, $maker),
            Shape::Square => new Square($name, $options, $maker),
            Shape::Tall => new Tall($name, $options, $maker),
            Shape::Wide => new Wide($name, $options, $maker),
        };
    }

    /**
     * Return the list of options to pass to the URL maker class for an image of
     * the given width.
     *
     * @return Map<string, OptionType>
     */
    protected function options(Size $size): Map
    {
        return $this->options->merge(['width' => $size]);
    }

    private function maker(): Maker
    {
        return $this->maker ?? Maker::defaultMaker();
    }
}
