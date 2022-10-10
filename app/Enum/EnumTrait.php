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

    public static function asKeyValue(): array
    {
        $data = [];
        foreach (self::cases() as $item) {
            $name = $item->name;
            $data[$item->value] = __('enums.' . self::class . '.' . $name);
        }

        return $data;
    }
}
