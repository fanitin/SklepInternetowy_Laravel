<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'address' => fake()->address(),
            'phone' => fake()->regexify('/^\+48[0-9]{9}$/'),
            'user_id' => User::get()->random()->id,
            'payment_id' => Payment::get()->random()->id,
            'status_id' => Status::get()->random()->id
        ];
    }
}
