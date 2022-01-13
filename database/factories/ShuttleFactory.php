<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShuttleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nopol = strtoupper(Str::random(1)).' '.$this->faker->randomNumber(4).' '.strtoupper(Str::random(rand(2,3)));
        
        return [
            'nopol'     => $nopol,
            'driver_id' => \App\Models\Driver::inRandomOrder()->first()->id,
            'shuttle_status' => $this->faker->randomElement(['Aktif', 'Tidak Aktif'])
        ];
    }
}
