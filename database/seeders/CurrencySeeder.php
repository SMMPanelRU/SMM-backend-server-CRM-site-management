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

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $currencies = [
            'RUB' => [
                'name' => ['en' => 'Rubble', 'ru' => 'Рубль'],
                'code' => 'RUB',
                'icon' => '₽',
            ],
            'USD' => [
                'name' => ['en' => 'USD Dollar', 'ru' => 'USD доллар'],
                'code' => 'USD',
                'icon' => '$',
            ],
        ];

        foreach ($currencies as $name => $data) {

            $currency          = new Currency();
            $currency->name    = $data['name'];
            $currency->code     = $data['code'];
            $currency->icon = $data['icon'];

            $currency->save();
        }

    }
}
