<?php

declare(strict_types=1);

/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license MIT
 */

namespace StevenBerg\ResponsibleImages;

/**
 * Interface for objects that can be converted to Image objects.
 */
interface ResponsiveImageable
{
    /**
     * Return an Image representation of the object.
     */
    public function toResponsiveImage(): Image;
}
