<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Database\Seeders\Fake\FakeCategorySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FakeCategorySeeder::class,
        ]);
    }
}
