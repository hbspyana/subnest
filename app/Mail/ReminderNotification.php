<?php

namespace App\Mail;

use App\Models\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReminderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Reminder $reminder)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subnest subscription reminder',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reminder-notification',
        );
    }
}