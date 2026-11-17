<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'price',
        'billing_cycle',
        'start_date',
        'next_payment_date',
        'status',
    ];
}
