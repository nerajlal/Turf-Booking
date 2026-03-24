<?php

namespace Database\Seeders;

use App\Models\Turf;
use Illuminate\Database\Seeder;

class TurfSeeder extends Seeder
{
    public function run(): void
    {
        Turf::create([
            'name' => 'Wembley Arena',
            'location' => 'Block A, Skyline, London',
            'price_per_hour' => 120.00,
            'description' => 'A world-class astroturf with premium floodlights and locker facilities.',
            'images' => [
                'https://example.com/images/turf1_1.jpg',
                'https://example.com/images/turf1_2.jpg'
            ]
        ]);

        Turf::create([
            'name' => 'Camp Nou Turf',
            'location' => 'Sector 7, Barcelona',
            'price_per_hour' => 150.00,
            'description' => 'Olympic-sized football turf with high-quality drainage system.',
            'images' => [
                'https://example.com/images/turf2_1.jpg',
                'https://example.com/images/turf2_2.jpg'
            ]
        ]);
    }
}
