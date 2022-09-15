<?php

namespace App\Enum\SystemLogs;

use App\Enum\EnumTrait;

enum SystemLogTypeEnum: int
{
    use EnumTrait;

    case Info = 0;
    case Debug = 1;
    case Warning = 2;
    case Error = 3;
    case Critical = 4;
}
