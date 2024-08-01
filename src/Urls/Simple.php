<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages\Urls;

use Ds\Map;
use StevenBerg\ResponsibleImages\Values\Value;

/**
 * Simple URL maker, mainly for testing.
 *
 * Assumes images have URLs like `https://example.com/width-100_image.jpg`
 * for the 100px version of image.jpg.
 */
class Simple extends Maker
{
    /**
     * Constructor.
     */
    public function __construct(private string $urlPrefix) {}

    /**
     * {@inheritdoc}
     */
    protected function url(string $name, Map $options): string
    {
        return "{$this->urlPrefix}/" . $this->joinOptions($options) . "_{$name}";
    }

    /** @param Map<string, mixed> $options */
    private function joinOptions(Map $options): string
    {
        return $options->pairs()
            ->map(function ($pair) {
                $value = is_a($pair->value, Value::class)
                    ? $pair->value->getValue()
                    : $pair->value;

                return "{$pair->key}-{$value}";
            })
            ->join('_')
        ;
    }
}
