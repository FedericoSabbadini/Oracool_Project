<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teams;

class DataLayer extends Model
{

public function randomInitialize()
{
    $teams = Teams::inRandomOrder()->get();
    $teamCount = $teams->count();

    if ($teamCount % 2 !== 0) {
        throw new \Exception("Il numero di squadre deve essere pari.");
    }

    $giornate = rand(1, 6);

    
    // Reset statistiche (opzionale se già azzerate altrove)
    foreach ($teams as $team) {
        $team->partiteVinte = 0;
        $team->partitePerse = 0;
        $team->partitePareggiate = 0;
        $team->partiteGiocate = 0;
        $team->punteggio = 0;
    }

    for ($g = 0; $g < $giornate; $g++) {
        $shuffled = $teams->shuffle();

        for ($i = 0; $i < $teamCount; $i += 2) {
            $team1 = $shuffled[$i];
            $team2 = $shuffled[$i + 1];

            $result = rand(0, 2); // 0 = team1 vince, 1 = pareggio, 2 = team2 vince

            if ($result === 0) {
                $team1->partiteVinte++;
                $team2->partitePerse++;
            } elseif ($result === 1) {
                $team1->partitePareggiate++;
                $team2->partitePareggiate++;
            } else {
                $team2->partiteVinte++;
                $team1->partitePerse++;
            }

            $team1->partiteGiocate++;
            $team2->partiteGiocate++;
        }
    }

    // Calcola punteggio e salva tutte le squadre
    foreach ($teams as $team) {
        $team->punteggio = ($team->partiteVinte * 3) + $team->partitePareggiate;
        $team->save(); // una sola query per team
    }

    return Teams::orderBy('punteggio', 'desc')->orderBy('nome', 'asc')->get();
}


    public function deleteAll()
    {
        Teams::get()->each(function ($team) {
            $team->update([
                'partiteVinte' => 0,
                'partitePareggiate' => 0,
                'partitePerse' => 0,
                'partiteGiocate' => 0,
                'punteggio' => 0
            ]);
        });
        return Teams::orderBy('nome', 'asc')->get();
    }

    public function getPunteggiMedi()
    {
        $teams = Teams::orderBy('punteggio', 'desc')->orderBy('nome', 'asc')->get();

        foreach ($teams as $team) {
            $punteggio = ($team->punteggio / $team->partiteGiocate);
            $team->punteggioMedio = round($punteggio, 3);
        }
        return $teams;
    }
}