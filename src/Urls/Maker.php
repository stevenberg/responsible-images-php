<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Urls;

use Ds\Map;
use RuntimeException;
use StevenBerg\ResponsibleImages\Values\Name;

/**
 * Interface for classes that generate resized image URLs.
 */
abstract class Maker
{
    private static $defaultMaker;

    /**
     * Make a URL.
     *
     * @param \StevenBerg\ResponsibleImages\Values\Name             $name    Image name
     * @param (\StevenBerg\ResponsibleImages\Values\Value|string)[] $options Options to pass to the resizing service
     */
    public function make(Name $name, Map $options): string
    {
        $options = $options
            ->filter(function ($key, $value) {
                return !$value->isExceptional();
            })
            ->ksorted()
        ;

        return $this->url($name, $options);
    }

    /**
     * Register the default Maker object to use when one isn't specified.
     *
     * @param self $maker The default Maker object
     */
    public static function registerDefaultMaker(self $maker): void
    {
        self::$defaultMaker = $maker;
    }

    /**
     * Return the default Maker object.
     */
    public static function defaultMaker(): self
    {
        if (!isset(self::$defaultMaker)) {
            throw new RuntimeException('Default URL maker has not been registered');
        }

        return self::$defaultMaker;
    }

    /**
     * Return a URL for the given image name and options.
     *
     * @param (\StevenBerg\ResponsibleImages\Values\Value|string)[] $options Options to pass to the resizing service
     */
    abstract protected function url(Name $name, Map $options): string;
}
