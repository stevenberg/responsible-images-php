<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Urls;

use RuntimeException;
use StevenBerg\ResponsibleImages\Values\Name;

/**
 * Interface for classes that generate resized image URLs.
 */
abstract class Maker
{
    /**
     * Return a URL for the given image name and options.
     *
     * @param \StevenBerg\ResponsibleImages\Values\Name $name The image name.
     * @param (\StevenBerg\ResponsibleImages\Values\Value|string)[] $options Options to pass to the resizing service.
     *
     * @return string The URL of the resized image.
     */
    abstract public function make(Name $name, array $options): string;

    private static $defaultMaker;

    public static function registerDefaultMaker(self $maker)
    {
        self::$defaultMaker = $maker;
    }

    public static function defaultMaker()
    {
        if (!isset(self::$defaultMaker)) {
            throw new RuntimeException('Default URL maker has not been registered');
        }

        return self::$defaultMaker;
    }
}
