<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'depature' => $this->faker->city(),
            'arrival' => $this->faker->city(),
            'price' => str_pad(rand(1,99), 5, "0", STR_PAD_RIGHT),
            'shuttle_id' => \App\Models\Shuttle::inRandomOrder()->first()->id,
        ];
    }
}
