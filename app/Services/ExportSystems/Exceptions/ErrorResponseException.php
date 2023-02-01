<?php

namespace App\Services\ExportSystems\Exceptions;

use App\Exceptions\ExportSystems\BaseExportSystemException;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

class ErrorResponseException extends BaseExportSystemException
{
    public function __construct(Response $response, Exception|ClientException $e)
    {

        parent::__construct();

        $json = json_decode($response->getBody()->getContents());
        if (!$json) {
            throw new \RuntimeException('Wrong answer');
        }

        $this->message = $json->error;

    }
}
