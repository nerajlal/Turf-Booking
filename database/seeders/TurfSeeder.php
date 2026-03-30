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
            'description' => 'A state-of-the-art facility featuring 4G professional astroturf, Olympic-grade floodlighting, and luxury changing rooms. Perfect for competitive leagues, training sessions, and corporate sports events. Our venue is the premier destination for sports enthusiasts in Northern Ireland, offering unmatched pitch quality and amenities.',
            'images' => [
                '/images/turf_grand_arena.png',
                '/images/football_field.png',
                '/images/hero_sports_ground.png'
            ],
            'amenities' => ['4G Professional Turf', 'HDR Floodlights', 'Luxury Changing Rooms', 'Free Secure Parking', 'High-Speed Wi-Fi', 'On-site Sports Café', 'Equipment Rental'],
            'opening_hours' => '07:00:00',
            'closing_hours' => '23:00:00',
            'rating_avg' => 4.9,
            'is_active' => true,
        ]);
    }
}
