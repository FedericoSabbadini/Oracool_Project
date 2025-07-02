<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transazioni>
 */
class TransazioniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'importo' => $this->faker->numberBetween(10, 2000),
            'descrizione' => $this->faker->sentence(),
            'tipo' => $this->faker->randomElement(['entrata', 'uscita']),
            'data' => $this->faker->date(),
        ];
    }
}
