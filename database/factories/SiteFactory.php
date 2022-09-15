<?php

namespace Database\Factories;

use App\Enum\DefaultStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->domainName(),
            'email'   => $this->faker->unique()->url(),
            'logo'    => $this->faker->imageUrl(),
            'api_key' => Hash::make(Str::random(10)),
            'status'  => $this->faker->randomElement(DefaultStatusEnum::cases()),
        ];
    }
}
