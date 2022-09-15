<?php

namespace Database\Factories;

use App\Enum\DefaultStatusEnum;
use App\Models\Faq;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question' => [
                'en' => $this->faker->sentence(2),
                'ru' => \Faker\Factory::create('ru_RU')->sentence(2),
            ],
            'answer' => [
                'en' => $this->faker->sentence(2),
                'ru' => \Faker\Factory::create('ru_RU')->sentence(2),
            ],
            'status'=>DefaultStatusEnum::ON,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Faq $faq) {
            $faq->sites()
                   ->attach(Site::inRandomOrder()->take(random_int(1, 5))->pluck('id'));
        });
    }
}
