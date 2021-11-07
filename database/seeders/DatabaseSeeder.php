<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Driver::factory(10)->create();
        \App\Models\Shuttle::factory(10)->create();
        \App\Models\Route::factory(10)->create();
        \App\Models\Schedule::factory(10)->create();
        \App\Models\Booking::factory(10)->create();
        \App\Models\BookingDetail::factory(10)->create();
        \App\Models\Payment::factory(10)->create();
    }
}
