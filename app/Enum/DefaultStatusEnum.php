<?php

namespace App\Enum;

enum DefaultStatusEnum: int
{
    use EnumTrait;

    case OFF = 0;
    case ON = 1;
}
