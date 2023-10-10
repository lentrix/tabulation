<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'CAST',
                'description' => 'College of Arts, Sciences, & Technology'
            ],
            [
                'name' => 'CON',
                'description' => 'College of Nursing'
            ],
            [
                'name' => 'CABM-B',
                'description' => 'Business Department'
            ],
            [
                'name' => 'CABM-H',
                'description' => 'Hospitality Department'
            ],
            [
                'name' => 'COE',
                'description' => 'College of Education'
            ],
            [
                'name' => 'CCJ',
                'description' => 'College of Criminal Justice'
            ],
        ];

        foreach($teams as $team) \App\Models\Team::create([
            'event_id' => 1,
            'name' => $team['name'],
            'description' => $team['description']
        ]);
    }
}
