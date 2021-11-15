<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'driver_name'   => $this->faker->name(),
            'address'       => $this->faker->address(),
            'number_phone'  => $this->faker->phoneNumber(),
            'driver_status' => $this->faker->randomElement(['Aktif', 'Tidak Aktif'])
        ];
    }
}
