<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Reminder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create the required admin account
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $music = Category::factory()->for($admin)->create([
            'name' => 'Music',
        ]);

        $entertainment = Category::factory()->for($admin)->create([
            'name' => 'Entertainment',
        ]);

        $productivity = Category::factory()->for($admin)->create([
            'name' => 'Productivity',
        ]);

        // Create subscriptions in those categories
        $netflix = Subscription::factory()
            ->for($admin)
            ->for($entertainment)
            ->create([
                'name' => 'Netflix',
                'price' => 12.99,
                'billing_cycle' => 'monthly',
            ]);

        $spotify = Subscription::factory()
            ->for($admin)
            ->for($entertainment)
            ->create([
                'name' => 'Spotify',
                'price' => 10.99,
                'billing_cycle' => 'monthly',
            ]);

        $notion = Subscription::factory()
            ->for($admin)
            ->for($productivity)
            ->create([
                'name' => 'Notion',
                'price' => 96.00,
                'billing_cycle' => 'yearly',
            ]);

        // Create payment records for each subscription
        Payment::factory()->count(2)->for($netflix)->create();
        Payment::factory()->count(2)->for($spotify)->create();
        Payment::factory()->count(2)->for($notion)->create();

        // Create reminders for each subscription
        Reminder::factory()->for($netflix)->create();
        Reminder::factory()->for($spotify)->create();
        Reminder::factory()->for($notion)->create();
    }
}