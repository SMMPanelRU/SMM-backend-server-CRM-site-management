<?php

namespace App\Enum\Orders;

use App\Enum\EnumTrait;

enum OrderStatusEnum: int
{
    use EnumTrait;

    case New = 0;
    case Paid = 1;
    case Started = 2;
    case Done = 3;
    case PartiallyDone = 4;
    case Cancel = 5;
    case PartiallyCancel = 6;
    case Error = 7;
}
