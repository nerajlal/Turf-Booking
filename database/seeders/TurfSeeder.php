<?php

namespace Database\Seeders;

use App\Models\Turf;
use Illuminate\Database\Seeder;

class TurfSeeder extends Seeder
{
    public function run(): void
    {
        Turf::create([
            'name' => 'The Grand Arena',
            'location' => 'Belfast, Northern Ireland',
            'latitude' => 54.5973,
            'longitude' => -5.9301,
            'price_per_hour' => 45.00,
            'description' => 'A state-of-the-art facility featuring 4G astroturf, professional-grade floodlighting, and changing rooms.',
            'images' => [
                '/images/turf_grand_arena.png',
                '/images/football_field.png'
            ],
            'amenities' => ['4G Turf', 'Floodlights', 'Changing Rooms', 'Free Parking', 'Wi-Fi'],
            'opening_hours' => '07:00:00',
            'closing_hours' => '23:00:00',
            'rating_avg' => 4.9,
            'is_active' => true,
        ]);

        Turf::create([
            'name' => 'University Sports Village',
            'location' => 'Jordanstown, Northern Ireland',
            'latitude' => 54.6853,
            'longitude' => -5.9036,
            'price_per_hour' => 35.00,
            'description' => 'High-performance sports village with indoor and outdoor pitches for all weather conditions.',
            'images' => [
                '/images/turf_university.png',
                '/images/swimming_pool.png'
            ],
            'amenities' => ['Indoor Pitch', 'Gym', 'Shower Facility', 'Cafeteria'],
            'opening_hours' => '08:00:00',
            'closing_hours' => '22:00:00',
            'rating_avg' => 4.7,
            'is_active' => true,
        ]);
    }
}
