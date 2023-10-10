<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = [
            [
                'label'=>'1st Place',
                'default_weight' => '10',
                'emblem' => './img/emblems/first_place_emblem.png',
                'event_id' => 1,
            ],
            [
                'label'=>'2nd Place',
                'default_weight' => '7',
                'emblem' => './img/emblems/second_place_emblem.png',
                'event_id' => 1,
            ],
            [
                'label'=>'3rd Place',
                'default_weight' => '5',
                'emblem' => './img/emblems/third_place_emblem.png',
                'event_id' => 1,
            ],
        ];

        foreach($places as $place) \App\Models\Place::create($place);
    }
}
