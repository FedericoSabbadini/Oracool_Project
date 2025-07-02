<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ExamsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $voto = fake()->numberBetween(0, 30);
        return [
            'nome' => fake()->firstName(),
            'cognome' => fake()->lastName(),
            'numMatricola' => fake()->numberBetween(100000, 999999),
            'voto' => $voto,
            'lode' => $voto === 30 ? fake()->boolean(50) : false,
            'data_esame' => fake()->date(),
            'commenti' => fake()->optional()->sentence(),
        ];
    }
}
