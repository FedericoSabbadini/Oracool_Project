<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Voti;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voti>
 */
class VotiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $voto = $this->faker->numberBetween(0, 31);
        if ($voto < 18) {
            $voto = -1;
        }
        return [
            'nome' => $this->faker->firstName(),
            'cognome' => $this->faker->lastName(),
            'numero_matricola' => $this->faker->numberBetween(100000, 999999),
            'voto' => $voto,
            'data_esame' => $this->faker->date(),
            'commenti' => $this->faker->optional()->sentence(),
        ];
    }
}
