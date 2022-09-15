<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'slug' => $this->faker->slug,
            'sort' => $this->faker->randomDigit(),
        ];
    }
}
