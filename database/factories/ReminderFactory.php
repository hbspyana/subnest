<?php

namespace Database\Factories;

use App\Models\Reminder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'reminder_date' => fake()->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'message' => fake()->randomElement([
                'Your subscription is renewing soon!',
                'Check your upcoming payment.',
                'Your subscription payment is due.',
            ]),
            'is_read' => fake()->boolean(),
        ];
    }
}
