<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turf extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'latitude',
        'longitude',
        'price_per_hour',
        'description',
        'images',
        'amenities',
        'opening_hours',
        'closing_hours',
        'rating_avg',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'amenities' => 'array',
        'price_per_hour' => 'decimal:2',
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
              ->orWhere('location', 'LIKE', "%$search%")
              ->orWhere('description', 'LIKE', "%$search%");
        });
    }

    public function scopeFilterByPrice($query, $maxPrice)
    {
        if (!$maxPrice) return $query;
        return $query->where('price_per_hour', '<=', $maxPrice);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
