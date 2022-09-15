<?php

namespace App\Exceptions\ExportSystems;

use Exception;

abstract class BaseExportSystemException extends Exception
{

    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

}
