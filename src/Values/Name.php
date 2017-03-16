<?php
/**
 * @author Steven Berg <steven@stevenberg.net>
 * @copyright 2017 Steven Berg
 * @license GNU General Public License, version 3
 */

namespace StevenBerg\ResponsibleImages\Values;

/**
 * Represents an image name.
 */
class Name extends Value
{
    /**
     * {@inheritDoc}
     *
     * A name is valid if it matches the regular expression
     * `/^[\w-]+(\/[\w-]+)*(\.(jpg|png))?$/i`.
     */
    protected function isValid(): bool
    {
        return is_string($this->value) &&
            preg_match('/^[\w-]+(\/[\w-]+)*(\.(jpg|png))?$/i', $this->value);
    }

    protected function invalidExceptionMesasge(): string
    {
        return 'Name value format must be string and valid format';
    }
}
