<?php

namespace App\Exceptions\Users;

class InsufficientFundsException extends BaseUserException
{
    public function __construct()
    {
        parent::__construct();

        $this->message = __('errors.insufficient funds');
    }
}
