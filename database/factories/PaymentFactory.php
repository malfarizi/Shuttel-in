<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_id'  => \App\Models\Booking::inRandomOrder()->first()->id,
            'total' => str_pad(rand(1,99), 4, "0", STR_PAD_RIGHT)
        ];
    }
}
