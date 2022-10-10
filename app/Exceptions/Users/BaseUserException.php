<?php

namespace App\Exceptions\Users;

use Exception;

abstract class BaseUserException extends Exception
{

    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

}
