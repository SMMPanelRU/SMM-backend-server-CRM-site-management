<?php

namespace Database\Seeders;

use App\Enum\DefaultStatusEnum;
use App\Models\Currency;
use App\Models\Site;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sites = [
            'Libgram'    => [
                'url'         => 'https://libgram.com',
                'api_key'     => Hash::make(Str::random(10)),
                'status'      => DefaultStatusEnum::ON,
                'currency_id' => Currency::query()->where(['code' => 'USD'])->first()->id,
            ],
            'Smoservice' => [
                'url'         => 'https://smoservice.net',
                'api_key'     => Hash::make(Str::random(10)),
                'status'      => DefaultStatusEnum::ON,
                'currency_id' => Currency::query()->where(['code' => 'RUB'])->first()->id,
            ],
            'Test site'  => [
                'url'         => 'https://test_site',
                'api_key'     => env('TEST_SITE_API_KEY') ?? Hash::make(Str::random(10)),
                'status'      => DefaultStatusEnum::ON,
                'currency_id' => Currency::query()->where(['code' => 'RUB'])->first()->id,
            ],
        ];

        foreach ($sites as $name => $data) {

            $site              = new Site();
            $site->name        = $name;
            $site->url         = $data['url'];
            $site->api_key     = $data['api_key'];
            $site->status      = $data['status'];
            $site->currency_id = $data['currency_id'];

            $logoFile = storage_path('seed_files/assets/images/sites/' . $name . '.png');

            if (file_exists($logoFile)) {

                $uploaded = Storage::disk('public')->putFileAs('images/sites', $logoFile, $name . '.png');

                $site->logo = $uploaded;
            }

            $site->save();
        }

    }
}
