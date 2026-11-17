<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    /** @use HasFactory<\Database\Factories\ReminderFactory> */
    use HasFactory;

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    protected $fillable = [
        'subscription_id',
        'reminder_date',
        'message',
        'is_read',
    ];
}
