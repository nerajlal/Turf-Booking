<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceLog extends Model
{
    protected $fillable = [
        'user_id',
        'metric',
        'value',
        'unit',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'date',
        'value' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
