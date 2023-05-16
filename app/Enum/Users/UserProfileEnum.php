<?php

namespace App\Enum\Users;

use App\Enum\EnumTrait;

enum UserProfileEnum: string
{
    use EnumTrait;

    case Name = 'name';
    case Surname = 'surname';
    case Phone = 'phone';
}
