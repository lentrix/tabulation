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
                'label'=>'Gold',
                'default_weight' => '10',
                'emblem' => './img/emblems/siklab_champion.png',
                'event_id' => 1,
            ],
            [
                'label'=>'Silver',
                'default_weight' => '7',
                'emblem' => './img/emblems/siklab_1st_runner_up.png',
                'event_id' => 1,
            ],
            [
                'label'=>'Bronze',
                'default_weight' => '5',
                'emblem' => './img/emblems/siklab_2nd_runner_up.png',
                'event_id' => 1,
            ],
            [
                'label'=>'4th Place',
                'default_weight' => '3',
                'emblem' => './img/emblems/fourth_place_emblem.png',
                'event_id' => 1,
            ],
            [
                'label'=>'5th Place',
                'default_weight' => '2',
                'emblem' => './img/emblems/fifth_place_emblem.png',
                'event_id' => 1,
            ],
            [
                'label'=>'6th Place',
                'default_weight' => '1',
                'emblem' => './img/emblems/sixth_place_emblem.png',
                'event_id' => 1,
            ],
        ];

        foreach($places as $place) \App\Models\Place::create($place);
    }
}
