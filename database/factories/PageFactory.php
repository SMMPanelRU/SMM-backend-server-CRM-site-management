<?php

namespace Database\Factories;

use App\Enum\DefaultStatusEnum;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
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
            'status'=>DefaultStatusEnum::ON,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Page $page) {
            $page->sites()
                ->attach(Site::inRandomOrder()->take(random_int(1, 5))->pluck('id'));
        });
    }
}
