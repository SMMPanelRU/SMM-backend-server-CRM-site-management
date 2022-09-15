<?php

namespace Database\Factories;

use App\Enum\DefaultStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => [
                'en' => $this->faker->sentence(2),
                'ru' => \Faker\Factory::create('ru_RU')->sentence(2),
            ],
            'short_description' => [
                'en' => $this->faker->sentence(2),
                'ru' => \Faker\Factory::create('ru_RU')->sentence(2),
            ],
            'description' => [
                'en' => $this->faker->sentence(2),
                'ru' => \Faker\Factory::create('ru_RU')->sentence(2),
            ],
            'slug' => $this->faker->slug,
            'sort' => $this->faker->randomDigit(),
            'price'=>$this->faker->randomFloat(2, 100, 500),
            'old_price'=>$this->faker->randomFloat(2, 100, 500),
            'multiplicity'=>$this->faker->numberBetween(1000, 10000),
            'status'=>DefaultStatusEnum::ON,

        ];
    }
}
