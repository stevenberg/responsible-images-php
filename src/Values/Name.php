<?php

namespace StevenBerg\ResponsiveImages\Values;

class Name extends Value
{
    protected function isValid(): bool
    {
        return is_string($this->value) &&
            preg_match('/^[\w-]+(\/[\w-]+)*(\.(jpg|png))?$/i', $this->value);
    }

    protected function invalidExceptionMesasge()
    {
        return 'Name value format must be string and valid format';
    }
}
