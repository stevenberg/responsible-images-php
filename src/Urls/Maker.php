<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Urls;

use Ds\Map;

/**
 * Interface for classes that generate resized image URLs.
 */
abstract class Maker
{
    private static Maker $defaultMaker;

    /**
     * Make a URL.
     *
     * @param  string  $name  Image name
     * @param  Map<string, OptionType>  $options  Options to pass to the resizing service
     */
    public function make(string $name, Map $options): string
    {
        return $this->url($name, $options->ksorted());
    }

    /**
     * Register the default Maker object to use when one isn't specified.
     *
     * @param  self  $maker  The default Maker object
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
            throw new \RuntimeException('Default URL maker has not been registered');
        }

        return self::$defaultMaker;
    }

    /**
     * Return a URL for the given image name and options.
     *
     * @param  Map<string, OptionType>  $options  Options to pass to the resizing service
     */
    abstract protected function url(string $name, Map $options): string;
}
