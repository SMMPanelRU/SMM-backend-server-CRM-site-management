<?php

namespace Database\Seeders;

use App\Enum\DefaultStatusEnum;
use App\Models\ExportSystem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ExportSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $exportSystem = [
            'Socgress' => [
                'name'     => [
                    'en' => 'Socgress',
                    'ru' => 'Socgress',
                ],
                'status'   => DefaultStatusEnum::ON,
                'slug'     => 'socgress',
                'handler'  => 'Socgress',
                'settings' => [
                    'api_key' => encrypt(env('SOCGRESS_API_KEY')),
                ],
            ],
        ];

        foreach ($exportSystem as $name => $data) {

            $exportSystem           = new ExportSystem();
            $exportSystem->name     = $data['name'];
            $exportSystem->status   = $data['status'];
            $exportSystem->slug     = $data['slug'];
            $exportSystem->handler  = $data['handler'];
            $exportSystem->settings = $data['settings'];

            $logoFile = storage_path('seed_files/assets/images/export_systems/' . $name . '.png');

            if (file_exists($logoFile)) {

                $uploaded = Storage::disk('public')->putFileAs('images/export_systems', $logoFile, $name . '.png');

                $exportSystem->logo = $uploaded;
            }

            $exportSystem->save();
        }

    }
}
