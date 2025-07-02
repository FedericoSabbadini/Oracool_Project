<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teams;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/teams.json');
        $json = file_get_contents($path);
        $teamsData = json_decode($json, true);

        foreach ($teamsData as $teamData) {
            Teams::create(
                ['nome' => $teamData['squadra']]
            );
        }
    }
}
