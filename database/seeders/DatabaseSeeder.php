<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InstallSeeder::class,
            CurrencySeeder::class,
            SiteSeeder::class,
            CategorySeeder::class,
            LangSeeder::class,
            AttributeSeeder::class,
            AttributePredefinedValueSeeder::class,
            ProductSeeder::class,
            ExportSystemSeeder::class,
            PaymentSystemSeeder::class,
        ]);
    }
}
