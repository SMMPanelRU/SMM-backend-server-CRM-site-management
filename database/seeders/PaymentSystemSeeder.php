<?php

namespace Database\Seeders;

use App\Enum\DefaultStatusEnum;
use App\Models\ExportSystem;
use App\Models\PaymentSystem;
use App\Models\Site;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PaymentSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $paymentSystems = [
            'Balance' => [
                'name'     => [
                    'en' => 'Balance',
                    'ru' => 'Баланс',
                ],
                'status'   => DefaultStatusEnum::ON,
                'slug'     => 'balance',
                'handler'  => 'Balance',
                'settings' => [],
            ],
            'TegroMoney' => [
                'name'     => [
                    'en' => 'TegroMoney',
                    'ru' => 'TegroMoney',
                ],
                'status'   => DefaultStatusEnum::ON,
                'slug'     => 'tegromoney',
                'handler'  => 'TegroMoney',
                'settings' => [
                    'public_key'=>'',
                    'api_key' => '',
                ],
            ],
        ];

        foreach ($paymentSystems as $name => $data) {

            $paymentSystem           = new PaymentSystem();
            $paymentSystem->name     = $data['name'];
            $paymentSystem->status   = $data['status'];
            $paymentSystem->slug     = $data['slug'];
            $paymentSystem->handler  = $data['handler'];
            $paymentSystem->settings = $data['settings'];

            $logoFile = storage_path('seed_files/assets/images/payment_systems/' . $name . '.png');

            if (file_exists($logoFile)) {

                $uploaded = Storage::disk('public')->putFileAs('images/payment_systems', $logoFile, $name . '.png');

                $paymentSystem->logo = $uploaded;
            }

            $paymentSystem->save();

            $paymentSystem->sites()->attach(Site::query()->pluck('id'));

        }

    }
}
