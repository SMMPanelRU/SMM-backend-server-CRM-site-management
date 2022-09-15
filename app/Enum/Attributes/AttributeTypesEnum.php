<?php

namespace App\Enum\Attributes;

use App\Enum\EnumTrait;

enum AttributeTypesEnum: int
{
    use EnumTrait;

    case Text = 0;
    case Textarea = 1;
    case Html = 2;
    case Select = 3;
    case Checkbox = 4;
    case Radio = 5;
    case File = 6;
}
