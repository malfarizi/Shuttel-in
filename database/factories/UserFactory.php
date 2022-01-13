<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model;
     *
     * @var string
     */

    protected $model = User::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'role'              => 'Customer',
            'email_verified_at' => now(),
            'address'           => $this->faker->address(),
            'phone_number'      => $this->faker->phoneNumber(),
            'password'          => 'password', // password
            'remember_token'    => Str::random(10),
        ];
    }

    public function admin() 
    {
        return $this->state([
            'name'  => 'Admin',
            'email' => 'admin@gmail.com',
            'role'  => 'Admin',
        ]);
    }
}