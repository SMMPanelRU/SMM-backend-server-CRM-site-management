<?php

namespace Database\Factories;

use App\Enum\Tickets\TicketStatusEnum;
use App\Models\Page;
use App\Models\Site;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\TicketAnswer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $site = Site::all()->random();

        return [
            'user_id' => User::query()->where('site_id', $site->id)->inRandomOrder()->first()->id,
            'site_id' => $site->id,
            'title'   => $this->faker->sentence(2),
            'body'    => $this->faker->sentence(),
        ];
    }

    public function configure()
    {

        return $this->afterCreating(function (Ticket $ticket) {

            $answers = rand(3, 10);

            for ($i = 0; $i < $answers; $i++) {
                $whoAnswer = rand(0, 1);

                $ticketAnswer = new TicketAnswer();
                $ticketAnswer->ticket()->associate($ticket);
                if ($whoAnswer === 0) {
                    $ticketAnswer->user()->associate($ticket->user_id);
                } else {
                    $ticketAnswer->admin()->associate(Team::query()->where('name', 'Administrators')->first()->allUsers()->random()->id);
                }
                $ticketAnswer->body = $this->faker->sentence();
                $ticketAnswer->save();

            }
        });
    }
}
