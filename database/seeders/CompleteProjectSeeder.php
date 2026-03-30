<?php

namespace Database\Seeders;

use App\Models\Turf;
use App\Models\Trainer;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompleteProjectSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // 1. Ensure a user exists
            $user = User::updateOrCreate(
                ['email' => 'user@example.com'],
                [
                    'name' => 'John Doe',
                    'password' => Hash::make('password'),
                    'skill_level' => 'Intermediate',
                    'sports' => ['Football', 'Badminton'],
                ]
            );

            // 2. Create NI Turfs
            $turfs = [
                [
                    'name' => 'Powerleague Belfast',
                    'location' => 'Belfast, BT12 6HU',
                    'latitude' => 54.5833,
                    'longitude' => -5.9333,
                    'price_per_hour' => 45.00,
                    'description' => 'Premium 5-a-side and 7-a-side football pitches in the heart of Belfast.',
                    'amenities' => ['Floodlights', 'Changing Rooms', 'Parking', 'Cafe'],
                    'opening_hours' => '08:00',
                    'closing_hours' => '22:00',
                    'rating_avg' => 4.8,
                    'is_active' => true,
                    'images' => ['images/football_field.png'],
                ],
                [
                    'name' => 'Ozone Indoor Tennis & Sports',
                    'location' => 'Ormeau Embankment, Belfast BT6 8LT',
                    'latitude' => 54.5800,
                    'longitude' => -5.9100,
                    'price_per_hour' => 35.00,
                    'description' => 'Top-tier indoor tennis courts and multi-purpose sports halls.',
                    'amenities' => ['Indoor', 'Tennis Courts', 'Locker Rooms'],
                    'opening_hours' => '07:00',
                    'closing_hours' => '21:00',
                    'rating_avg' => 4.5,
                    'is_active' => true,
                    'images' => ['images/badminton_court.png'],
                ],
                [
                    'name' => 'Lisburn Leisureplex',
                    'location' => 'Lisburn, BT28 1LP',
                    'latitude' => 54.5167,
                    'longitude' => -6.0333,
                    'price_per_hour' => 40.00,
                    'description' => 'Olympic-sized swimming pools and large multi-sports arenas.',
                    'amenities' => ['Swimming Pool', 'Gym', 'Sauna'],
                    'opening_hours' => '06:00',
                    'closing_hours' => '23:00',
                    'rating_avg' => 4.7,
                    'is_active' => true,
                    'images' => ['images/swimming_pool.png'],
                ],
            ];

            foreach ($turfs as $turfData) {
                Turf::updateOrCreate(['name' => $turfData['name']], $turfData);
            }

            // 3. Create Trainers
            $trainers = [
                [
                    'name' => 'Coach Mark O’Neill',
                    'specialization' => 'Football Performance',
                    'hourly_rate' => 30.00,
                    'bio' => 'UEFA B Licensed coach focused on youth development and technical excellence in Belfast.',
                    'rating_avg' => 4.9,
                    'is_active' => true,
                    'image' => 'images/trainer_action.png',
                ],
                [
                    'name' => 'Sarah Campbell',
                    'specialization' => 'Badminton Specialist',
                    'hourly_rate' => 25.00,
                    'bio' => 'Former national player providing top-level badminton coaching for all skill levels.',
                    'rating_avg' => 4.6,
                    'is_active' => true,
                    'image' => 'images/swimming_pool.png',
                ],
            ];

            foreach ($trainers as $trainerData) {
                Trainer::updateOrCreate(['name' => $trainerData['name']], $trainerData);
            }

            // 4. Create Events
            $events = [
                [
                    'title' => 'Belfast Masters Football Cup',
                    'description' => 'The ultimate 5-a-side challenge for regional teams in Northern Ireland.',
                    'event_date' => now()->addDays(10),
                    'price' => 20.00,
                    'capacity' => 100,
                    'is_active' => true,
                    'image' => 'images/event_football.png',
                ],
                [
                    'title' => 'NI Open Badminton Night',
                    'description' => 'A friendly yet competitive meetup for badminton enthusiasts at the Ozone.',
                    'event_date' => now()->addDays(15),
                    'price' => 10.00,
                    'capacity' => 40,
                    'is_active' => true,
                    'image' => 'images/event_badminton.png',
                ],
            ];

            foreach ($events as $eventData) {
                Event::updateOrCreate(['title' => $eventData['title']], $eventData);
            }
        } catch (\Exception $e) {
            $this->command->error($e->getMessage());
        }
    }
}
