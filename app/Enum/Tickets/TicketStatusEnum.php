<?php

namespace App\Enum\Tickets;

use App\Enum\EnumTrait;

enum TicketStatusEnum: int
{
    use EnumTrait;

    case New = 0;
    case WaitAdmin = 1;
    case WaitUser = 2;
    case Working = 3;
    case Closed = 4;
}
