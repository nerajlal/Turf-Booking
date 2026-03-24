<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'turf_id',
        'user_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'payment_status',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function turf()
    {
        return $this->belongsTo(Turf::class);
    }
}
