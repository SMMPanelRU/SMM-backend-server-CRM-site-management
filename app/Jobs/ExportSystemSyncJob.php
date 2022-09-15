<?php

namespace App\Jobs;

use App\Enum\SystemLogs\SystemLogTypeEnum;
use App\Services\ExportSystems\BaseExportSystem;
use App\Services\SystemLogService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportSystemSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly string $handler)
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
            $instance = (new BaseExportSystem())->getInstance($this->handler);
        } catch (\Throwable $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $instance->syncServices();
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
