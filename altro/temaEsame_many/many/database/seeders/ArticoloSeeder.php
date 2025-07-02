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
        Articolo::factory()->count(10)->create();

        $autori = Autore::all();
        $articoli = Articolo::all();
        foreach ($articoli as $articolo) {
            $articolo->autori()->attach(
                $autori->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
