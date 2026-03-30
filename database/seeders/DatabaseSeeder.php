<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Mock Playpals
        $names = ['James Wilson', 'Sarah O\'Neill', 'Mark Thompson', 'Emma Bradley'];
        foreach ($names as $name) {
            User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'password' => bcrypt('password'),
                'sports' => ['Football', 'Cricket'],
                'skill_level' => ['Beginner', 'Intermediate', 'Pro'][rand(0, 2)],
            ]);
        }

        $this->call(TurfSeeder::class);

        // Mock Events
        \App\Models\Event::create([
            'title' => 'Belfast Community Cup',
            'description' => 'A friendly football tournament for all skill levels. Join us for a day of sports and community networking.',
            'event_date' => now()->addDays(14),
            'price' => 20.00,
            'max_participants' => 32,
            'qr_id' => 'EVENT-001',
        ]);

        \App\Models\Event::create([
            'title' => 'Jordanstown Cricket Bash',
            'description' => 'Annual summer cricket competition. T20 format with professional umpires.',
            'event_date' => now()->addDays(21),
            'price' => 15.00,
            'max_participants' => 24,
            'qr_id' => 'EVENT-002',
        ]);
    }
}
