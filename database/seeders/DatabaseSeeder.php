<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'full_name' => 'Benjie B. Lenteria',
            'email' => 'me@lentrix-dev.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role' => 'admin'
        ]);

        \App\Models\Event::create([
            'title' => 'MDC Siklab 2023',
            'description' => 'MDC Intramurals 2023',
            'start' => '2023-10-26 07:00',
            'end' => '2023-10-28 22:00'
        ]);

        $this->call(TeamSeeder::class);

        $this->call(PlaceSeeder::class);

        $this->call(CompetitionSeeder::class);

    }
}
