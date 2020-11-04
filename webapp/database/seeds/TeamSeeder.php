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
            'type' => 'Production',
            'gps_x' => 1.12,
            'gps_y' => 0.123123,
        ]);
        Team::create([
            'name' => 'team2',
            'type' => 'Production',
            'gps_x' => 10.01,
            'gps_y' => 10.9,
        ]);
        Team::create([
            'name' => 'team3',
            'type' => 'Control',
            'gps_x' => 20.0,
            'gps_y' => 20.1,
        ]);
    }
}
