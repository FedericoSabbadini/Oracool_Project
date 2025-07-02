<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Studente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Studente>
 */
class StudenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = $this->faker->firstName();
        $cognome = $this->faker->lastName();
        $dataAppello = $this->faker->dateTimeBetween('-1 year', 'now');
        $numeroMatricola = $this->faker->unique()->numberBetween(100000, 999999);
        $voto = $this->faker->numberBetween(0, 30);
        if ($voto === 30) {
            $lode = $this->faker->boolean(50); 
            if ($lode) {
                $voto = 33;
            }
        }
        if ($voto < 18) {
            $voto = -1;
        }

        return [
            'nome' => $nome,
            'cognome' => $cognome,
            'data_appello' => $dataAppello,
            'numero_matricola' => $numeroMatricola,
            'voto' => $voto,
        ];
    }
}
