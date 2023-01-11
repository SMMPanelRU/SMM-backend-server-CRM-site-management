<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'count' => $this->faker->randomNumber(),
            'done_count' => $this->faker->randomNumber(),
            'export_system_product_id' => $this->faker->randomNumber(),
            'export_system_status' => $this->faker->randomNumber(),
            'export_system_status_description' => $this->faker->text(),

            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
