<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comps = [
            ['name'=>'Lawn Tennis (Singles Men)','in_charge'=>'Benjie B. Lenteria'],
            ['name'=>'Lawn Tennis (Doubles Men)','in_charge'=>'Benjie B. Lenteria'],
            ['name'=>'Lawn Tennis (Singles Women)','in_charge'=>'Benjie B. Lenteria'],
            ['name'=>'Lawn Tennis (Doubles Women)','in_charge'=>'Benjie B. Lenteria'],
            ['name'=>'Table Tennis (Singles Men)','in_charge'=>'John Senegz Astacaan'],
            ['name'=>'Table Tennis (Doubles Men)','in_charge'=>'John Senegz Astacaan'],
            ['name'=>'Table Tennis (Singles Women)','in_charge'=>'John Senegz Astacaan'],
            ['name'=>'Table Tennis (Doubles Women)','in_charge'=>'John Senegz Astacaan'],
            ['name'=>'Basketball (Men)','in_charge'=>'Artemio Gulilat'],
            ['name'=>'Basketball (Women)','in_charge'=>'Artemio Gulilat'],
            ['name'=>'Volleyball (Men)','in_charge'=>'Jurly Lopoz'],
            ['name'=>'Volleyball (Women)','in_charge'=>'Jurly Lopoz'],
            ['name'=>'Sepak Takraw Regu A','in_charge'=>'Aileen Lopez'],
            ['name'=>'Sepak Takraw Regu B','in_charge'=>'Aileen Lopez'],
            ['name'=>'Chess (Men)','in_charge'=>'Christopher Arcay'],
            ['name'=>'Chess (Women)','in_charge'=>'Christopher Arcay'],
            ['name'=>'Badminton (Singles Men)','in_charge'=>'Joel Balibagoso'],
            ['name'=>'Badminton (Singles Women)','in_charge'=>'Joel Balibagoso'],
            ['name'=>'Badminton (Doubles Men)','in_charge'=>'Joel Balibagoso'],
            ['name'=>'Badminton (Doubles Women)','in_charge'=>'Joel Balibagoso'],
            ['name'=>'100 Meter Sprint (Men)','in_charge'=>'Jose Ruel Alampayan'],
            ['name'=>'200 Meter Run (Men)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'400 Meter Run (Men)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'1000 Meter Run (Men)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'100 Meter Sprint (Women)','in_charge'=>'Jose Ruel Alampayan'],
            ['name'=>'200 Meter Run (Women)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'400 Meter Run (Women)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'1000 Meter Run (Women)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'Shot put (Men)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'Shot put (Women)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'Long Jump (Women)','in_charge'=>'Jose Ruel Almpayan'],
            ['name'=>'Long Jump (Men)','in_charge'=>'Jose Ruel Almpayan'],
        ];

        foreach($comps as $comp) Competition::create([
            'event_id' => 1,
            'name' => $comp['name'],
            'in_charge' => $comp['in_charge'],
        ]);
    }
}
