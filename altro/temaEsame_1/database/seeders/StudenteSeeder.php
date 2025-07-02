<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Studente;

class StudenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Studente::create([
            'dataAppello' => '2025-06-20',
            'numMatricola' => 735681,
            'cognome' => 'Sabbadini',
            'nome' => 'Federico',
            'voto' => 30,
        ]);
        Studente::create([
            'dataAppello' => '2025-06-20',
            'numMatricola' => 735682,
            'cognome' => 'Rossi',
            'nome' => 'Mario',
            'voto' => 28,
        ]);
        Studente::create([
            'dataAppello' => '2025-06-20',
            'numMatricola' => 735683,
            'cognome' => 'Bianchi',
            'nome' => 'Luca',
            'voto' => 25,
        ]);
        Studente::create([
            'dataAppello' => '2025-06-20',
            'numMatricola' => 735684,
            'cognome' => 'Verdi',
            'nome' => 'Giulia',
            'voto' => 30,
        ]);
        Studente::create([
            'dataAppello' => '2025-06-20',
            'numMatricola' => 735685,
            'cognome' => 'Neri',
            'nome' => 'Alessandro',
            'voto' => 18,
        ]);
        Studente::create([
            'dataAppello' => '2025-06-20',
            'numMatricola' => 735686,
            'cognome' => 'Gialli',      
            'nome' => 'Chiara',
            'voto' => 33,
        ]);
    }
}
