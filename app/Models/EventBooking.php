<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_id',
        'price_paid',
        'payment_status',
        'booked_at',
    ];

    protected $casts = [
        'booked_at' => 'datetime',
        'price_paid' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
