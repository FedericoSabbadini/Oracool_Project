<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Autore;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Autore>
 */
class AutoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->firstName(),
            'cognome' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'istituto' => $this->faker->company(),
        ];
    }
}
