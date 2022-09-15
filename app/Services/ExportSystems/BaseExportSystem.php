<?php

namespace App\Services\ExportSystems;

use App\Exceptions\UndefinedHandlerException;
use App\Exceptions\UndefinedHandlerInstanceException;
use App\Exceptions\UndefinedHandlerModelException;
use App\Exceptions\UndefinedHandlerSettingsException;
use App\Models\ExportSystem;
use App\Models\ExportSystemProduct;
use App\Models\SystemLog;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class BaseExportSystem
{

    public static string   $name        = 'undefined';
    public static string   $description = 'undefined';
    public array           $params;
    public array           $settings;
    protected Client       $client;
    protected string       $apiUrl      = '';
    protected SystemLog    $systemLog;
    protected ExportSystem $exportSystem;

    public function setSystemLog(SystemLog $systemLog): BaseExportSystem
    {
        $this->systemLog = $systemLog;

        return $this;
    }

    public function getSystemLog(): SystemLog
    {
        return $this->systemLog;
    }

    public function getHandlers(): array
    {
        $handlers = [];
        foreach (config('export_systems') as $handler) {
            $handlers[$handler::$name] = $handler::$description;
        }

        return $handlers;
    }

    /**
     * @throws \Throwable
     */
    public function getInstance(string $handler): BaseExportSystem
    {

        if (!in_array(ucfirst($handler), array_flip($this->getHandlers()))) {
            throw new UndefinedHandlerException();
        }

        $class = config('export_systems')[ucfirst($handler)];

        if (class_exists($class)) {
            /* @var \App\Services\ExportSystems\BaseExportSystem $instance */
            $instance         = new $class;
            $instance->client = new Client([
                'base_uri' => $instance->apiUrl,
            ]);

            $exportSystem = ExportSystem::query()->where('handler', $handler)->first();
            if ($exportSystem === null) {
                throw new UndefinedHandlerModelException();
            }

            $instance->exportSystem = $exportSystem;
            $instance->settings     = $exportSystem->settings;
            $instance->params       = $this->getParams($instance);

            foreach ($instance->params as $paramKey=>$paramValue) {
                foreach ($instance->settings as $settingKey=>$settingValue) {
                    if ($settingKey === $paramKey && ($paramValue['secret'] ?? null) === true && $settingValue ?? null) {
                        $instance->settings[$settingKey] = decrypt($settingValue);
                    }
                }
            }

            return $instance;
        }

        throw new UndefinedHandlerInstanceException();
    }

    public function getParams($instance)
    {
        return $instance->params();
    }

    public function getBalance(): float
    {
        return 0;
    }

    public function syncServices(): void
    {
        $services     = $this->getServices();
        $exportSystem = $this->exportSystem;

        $services->each(function ($service) use ($exportSystem) {
            /* @var \App\Services\ExportSystems\ExportSystemProductsParameters $service */

            ExportSystemProduct::query()->updateOrCreate(
                [
                    'export_system_id' => $exportSystem->id,
                    'unique_id'        => $service->getUniqueId(),
                ],
                [
                    'name'  => $service->getName(),
                    'price' => $service->getPrice(),
                    'min'   => $service->getMin(),
                    'max'   => $service->getMax(),
                    'data'  => $service->getData(),
                ]
            );
        });
    }

    public function getServices(): Collection
    {
        return new Collection();
    }
}
