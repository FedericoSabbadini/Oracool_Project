<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Articolo;
use App\Models\Autore;

class ArticoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articoli = Articolo::factory()->count(10)->create();

        foreach ($articoli as $articolo) {
            $autori = Autore::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $articolo->autori()->attach($autori);
        }
    }
}
    
