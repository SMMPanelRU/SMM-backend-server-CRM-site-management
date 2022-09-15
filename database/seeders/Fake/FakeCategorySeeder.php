<?php

namespace Database\Seeders\Fake;

use App\Models\Category;
use Illuminate\Database\Seeder;

class FakeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)
            ->hasChildCategories(5)
            ->create();
    }
}
