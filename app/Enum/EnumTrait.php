<?php

namespace App\Enum;

trait EnumTrait
{
    public function label(): string {
        return $this->getLabel();
    }

    public  function getLabel(): string
    {

        $key   = 'enums.' . self::class . '.' . $this->name ;
        $label = __($key);

        return ($label === $key ? $this->name : $label);

    }
}
