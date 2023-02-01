<?php

namespace App\Services\ExportSystems\Exceptions;

use App\Exceptions\ExportSystems\BaseExportSystemException;

class CreateExportException extends BaseExportSystemException
{
    public function __construct($message)
    {

        parent::__construct();

        $this->message = $message;

    }
}
