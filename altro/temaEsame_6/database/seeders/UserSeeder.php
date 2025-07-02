<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // Importa il modello User
use Illuminate\Support\Facades\Hash; // Importa la classe Hash per la crittografia delle password
use Illuminate\Support\Str; // Importa la classe Str per generare stringhe casuali
use Illuminate\Support\Facades\DB; // Aggiungi questa riga per importare la facciata DB

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un utente amministratore
        $user = User::create([
            'name' => 'federico',
            'email' => 'federicosabbadini@icloud.com',
            'password' => Hash::make('sabbadini'), // bcrypt sicuro
            'remember_token' => Str::random(10),

        ]);

        // Avvia una sessione per l'utente appena creato
        DB::table('sessions')->insert([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'payload' => '',
            'last_activity' => now()->timestamp,
        ]);

        // Crea altri 9 utenti tramite la factory
        User::factory()->count(9)->create();
    }
}
