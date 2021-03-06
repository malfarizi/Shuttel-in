<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 'SEAT-'.$this->faker->unique()->randomNumber(4),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'schedule_id' => \App\Models\Schedule::inRandomOrder()->first()->id
        ];
    }
}
