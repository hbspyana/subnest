<?php

namespace App\Console\Commands;

use App\Mail\ReminderNotification;
use App\Models\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    /**
     * Execute the console command.
     */
    protected $signature = 'reminders:send-emails';

    protected $description = 'Send emails for due subscription reminders';

    public function handle(): int
    {
        $reminders = Reminder::whereDate('reminder_date', '<=', now()->toDateString())
            ->whereNull('email_sent_at')
            ->with('subscription.user')
            ->get();

        $sent = 0;

        foreach ($reminders as $reminder) {
            $user = $reminder->subscription->user;

            if (!$user || !$user->email) {
                continue;
            }

            Mail::to($user->email)->send(
                new ReminderNotification($reminder)
            );

            $reminder->update([
                'email_sent_at' => now(),
            ]);

            $sent++;
        }

        $this->info($sent . ' reminder email(s) sent.');

        return self::SUCCESS;
    }
}
