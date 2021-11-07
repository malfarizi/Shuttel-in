<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingDetailFactory extends Factory
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
            'seat_number' => rand(0, 7),
            'subtotal'    => str_pad(rand(1,99), 4, "0", STR_PAD_RIGHT),
        ];
    }
}
