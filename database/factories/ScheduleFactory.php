<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_of_depature' => $this->faker->date(),
            'depature_time'    => $this->faker->time('H:i'),
            'route_id'         => \App\Models\Route::inRandomOrder()->first()->id
        ];
    }
}
