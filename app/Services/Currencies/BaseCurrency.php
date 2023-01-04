<?php

namespace App\Services\Currencies;

use App\Exceptions\UndefinedHandlerException;
use App\Exceptions\UndefinedHandlerInstanceException;
use App\Exceptions\UndefinedHandlerModelException;
use App\Exceptions\UndefinedHandlerSettingsException;
use App\Models\Currency;
use App\Models\ExportSystem;
use App\Models\ExportSystemProduct;
use App\Models\SystemLog;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class BaseCurrency
{

    public static string   $name        = 'undefined';
    public static string   $description = 'undefined';
    protected Client       $client;
    protected SystemLog    $systemLog;
    protected Currency $currency;

    public function setSystemLog(SystemLog $systemLog): BaseCurrency
    {
        $this->systemLog = $systemLog;

        return $this;
    }

    public function getSystemLog(): SystemLog
    {
        return $this->systemLog;
    }

    /**
     * @throws \Throwable
     */
    public function getInstance(Currency $currency): BaseCurrency
    {

        $class = 'App\Services\Currencies\\'.ucfirst(strtolower($currency->code)).'CurrencyService';

        if (class_exists($class)) {
            /* @var \App\Services\Currencies\BaseCurrency $instance */
            $instance         = new $class;
            $instance->currency = $currency;
            return $instance;
        }

        throw new UndefinedHandlerInstanceException();
    }

    public function updateCourse()
    {
        try {
            $course = $this->getCourse();
        } catch (Exception) {
            return false;
        }

        $this->currency->course = $course;
        $this->currency->save();

        return true;
    }

    /**
     * @throws Exception
     */
    public function getCourse(): float
    {
        return 0;
    }

}
