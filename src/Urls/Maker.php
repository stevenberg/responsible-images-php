<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
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
    /**
     * Return a URL for the given image name and options.
     *
     * @param (\StevenBerg\ResponsibleImages\Values\Value|string)[] $options Options to pass to the resizing service.
     */
    abstract protected function url(Name $name, Map $options): string;

    public function make(Name $name, array $options): string
    {
        $options = (new Map($options))->filter(function ($key, $value) {
            return !$value->isExceptional();
        });

        return $this->url($name, $options);
    }

    private static $defaultMaker;

    public static function registerDefaultMaker(self $maker): void
    {
        self::$defaultMaker = $maker;
    }

    public static function defaultMaker(): self
    {
        if (!isset(self::$defaultMaker)) {
            throw new RuntimeException('Default URL maker has not been registered');
        }

        return self::$defaultMaker;
    }
}
