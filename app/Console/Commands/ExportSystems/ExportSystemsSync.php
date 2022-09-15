<?php

namespace App\Console\Commands\ExportSystems;

use App\Enum\SystemLogs\SystemLogTypeEnum;
use App\Jobs\ExportSystemSyncJob;
use App\Models\ExportSystem;
use App\Services\ExportSystems\BaseExportSystem;
use App\Services\SystemLogService;
use Illuminate\Console\Command;

class ExportSystemsSync extends Command
{
    protected $signature   = 'export:sync';
    protected $description = 'Export systems syncing';

    public function handle()
    {

        $exportSystems = ExportSystem::query()->active()->get();



        foreach ($exportSystems as $exportSystem) {
            ExportSystemSyncJob::dispatch($exportSystem->handler);
        }


        exit(0);
    }
}
