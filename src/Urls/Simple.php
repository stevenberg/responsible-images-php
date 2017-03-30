<?php

declare(strict_types=1);
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Urls;

use Ds\Map;
use StevenBerg\ResponsibleImages\Values\Name;

/**
 * Simple URL maker, mainly for testing.
 *
 * Assumes images have URLs like `https://example.com/width-100_image.jpg`
 * for the 100px version of image.jpg.
 */
class Simple extends Maker
{
    private $urlPrefix;

    /**
     * Constructor.
     */
    public function __construct(string $urlPrefix)
    {
        $this->urlPrefix = $urlPrefix;
    }

    protected function url(Name $name, Map $options): string
    {
        return "$this->urlPrefix/" . $this->joinOptions($options) . "_$name";
    }

    private function joinOptions(Map $options): string
    {
        return $options->pairs()
            ->map(function ($pair) {
                return "$pair->key-$pair->value";
            })
            ->join('_');
    }
}
