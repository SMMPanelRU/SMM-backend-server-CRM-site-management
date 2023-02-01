<?php

use App\Services\ExportSystems\Socgress\SocgressExportSystem;
use \App\Services\ExportSystems\Justanotherpanel\JustanotherpanelExportSystem;

return [
    'Socgress' => SocgressExportSystem::class,
    'Justanotherpanel' => JustanotherpanelExportSystem::class,
];
