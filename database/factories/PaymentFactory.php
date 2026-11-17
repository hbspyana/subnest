<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 3, 30),
            'payment_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'status' => fake()->randomElement([
                'paid',
                'pending',
                'failed',
            ]),
        ];
    }
}