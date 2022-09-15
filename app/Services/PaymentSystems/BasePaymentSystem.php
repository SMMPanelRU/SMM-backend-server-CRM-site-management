<?php

namespace App\Services\PaymentSystems;

use App\Exceptions\UndefinedHandlerException;
use App\Exceptions\UndefinedHandlerInstanceException;
use App\Exceptions\UndefinedHandlerSettingsException;
use App\Models\PaymentSystem;
use GuzzleHttp\Client;

class BasePaymentSystem
{

    public static string $name        = 'undefined';
    public static string $description = 'undefined';
    public array         $params;
    public array         $settings;
    protected Client     $client;
    protected string     $apiUrl      = '';

    public function getHandlers(): array
    {
        $handlers = [];
        foreach (config('payment_systems') as $handler) {
            $handlers[$handler::$name] = $handler::$description;
        }

        return $handlers;
    }

    /**
     * @throws \Throwable
     */
    public function getSettings(BasePaymentSystem $instance): array
    {

        $paymentSystem = PaymentSystem::query()->where('handler', $instance::$name)->first();

        if ($paymentSystem === null) {
            throw new UndefinedHandlerSettingsException();
        }

        return $paymentSystem->settings ?? [];

    }

    /**
     * @throws \Throwable
     */
    public function getInstance(string $handler): BasePaymentSystem
    {

        if (!in_array(ucfirst($handler), array_flip($this->getHandlers()))) {
            throw new UndefinedHandlerException();
        }

        $class = config('payment_systems')[ucfirst($handler)];

        if (class_exists($class)) {
            /* @var \App\Services\PaymentSystems\BasePaymentSystem $instance */
            $instance           = new $class;
            $instance->client   = new Client([
                'base_uri' => $instance->apiUrl,
            ]);
            $instance->settings = $this->getSettings($instance);
            $instance->params   = $this->getParams($instance);

            return $instance;
        }

        throw new UndefinedHandlerInstanceException();
    }

    public function getParams($instance)
    {
        return $instance->params();
    }

}
