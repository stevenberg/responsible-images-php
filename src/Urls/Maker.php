<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsiveImages\Urls;

use StevenBerg\ResponsiveImages\Values\Name;

/**
 * Interface for classes that generate resized image URLs.
 */
interface Maker
{
    /**
     * Return a URL for the given image name and options.
     *
     * @param \StevenBerg\ResponsiveImages\Values\Name $name The image name.
     * @param (\StevenBerg\ResponsiveImages\Values\Value|string)[] $options Options to pass to the resizing service.
     *
     * @return string The URL of the resized image.
     */
    public function make(Name $name, array $options): string;
}
