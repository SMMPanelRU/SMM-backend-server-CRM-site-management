<?php

namespace App\Exceptions;

use App\Exceptions\ExportSystems\BaseExportSystemException;

class UndefinedHandlerSettingsException extends BaseExportSystemException
{
    public function __construct()
    {
        parent::__construct();

        $this->message = __('errors.undefined_handler_settings');
    }
}
