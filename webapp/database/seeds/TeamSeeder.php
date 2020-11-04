<?php

use App\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Team::create([
            'name' => 'team1',
            'type' => 'type1',
        ]);
        Team::create([
            'name' => 'team2',
            'type' => 'type1',
        ]);
        Team::create([
            'name' => 'team3',
            'type' => 'type2',
        ]);
    }
}
