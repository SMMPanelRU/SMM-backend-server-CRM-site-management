<?php

namespace App\Jobs;

use App\Enum\SystemLogs\SystemLogTypeEnum;
use App\Models\Currency;
use App\Services\Currencies\BaseCurrency;
use App\Services\ExportSystems\BaseExportSystem;
use App\Services\SystemLogService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CurrencyCourseLoadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly Currency $currency)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try {
            $instance = (new BaseCurrency())->getInstance($this->currency);
        } catch (\Throwable $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $instance->updateCourse();
    }

    public function failed(\Throwable $exception)
    {
        (new SystemLogService())
            ->setClass(get_class($this))
            ->setMethod(__FUNCTION__)
            ->setType(SystemLogTypeEnum::Critical)
            ->setMessage($exception->getMessage())
            ->log();
    }
}
