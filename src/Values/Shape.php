<?php

namespace StevenBerg\ResponsiveImages\Values;

class Shape extends Value
{
    const VALUES = ['original', 'square', 'tall', 'wide'];

    protected function isValid()
    {
        return is_string($this->value) && in_array($this->value, self::VALUES);
    }

    protected function invalidExceptionMesasge()
    {
        return 'Shape value must be one of ' . implode(', ', self::VALUES);
    }
}
