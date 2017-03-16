<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Urls;

use StevenBerg\ResponsibleImages\Values\Name;

/**
 * Simple URL maker, mainly for testing.
 *
 * Assumes images have URLs like `https://example.com/width-100_image.jpg`
 * for the 100px version of image.jpg.
 */
class Simple implements Maker
{
    private $urlPrefix;

    /**
     * Constructor.
     *
     * @param string $urlPrefix Value to prefix to generated URLs, e.g. `https://example.com`
     */
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
