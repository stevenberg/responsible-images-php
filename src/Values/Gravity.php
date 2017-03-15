<?php

namespace StevenBerg\ResponsiveImages\Values;

class Gravity extends Value
{
    const VALUES = ['auto', 'center'];

    protected function isValid()
    {
        return is_string($this->value) && in_array($this->value, self::VALUES);
    }

    protected function invalidExceptionMesasge()
    {
        return 'Gravity value must be one of ' . implode(', ', self::VALUES);
    }
}
