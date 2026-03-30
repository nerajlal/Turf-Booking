<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'hourly_rate',
        'bio',
        'image',
        'rating_avg',
        'is_active',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'rating_avg' => 'decimal:2',
        'is_active' => 'boolean',
    ];
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch($query, $search)
    {
        if (!$search) return $query;
        return $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%$search%")
              ->orWhere('specialization', 'LIKE', "%$search%")
              ->orWhere('bio', 'LIKE', "%$search%");
        });
    }

    public function scopeFilterByRate($query, $maxRate)
    {
        if (!$maxRate) return $query;
        return $query->where('hourly_rate', '<=', $maxRate);
    }
}
