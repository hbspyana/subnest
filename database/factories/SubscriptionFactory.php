<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Netflix',
                'Spotify',
                'Disney+',
                'YouTube Premium',
                'Playstation Plus',
            ]),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 3, 30),
            'billing_cycle' => fake()->randomElement([
                'weekly',
                'monthly',
                'yearly',
            ]),
            'start_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'next_payment_date' => fake()->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'status' => fake()->randomElement([
                'active',
                'paused',
                'cancelled',
            ]),
        ];
    }
}
