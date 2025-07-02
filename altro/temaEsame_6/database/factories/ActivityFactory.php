<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Activity;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titolo' => $this->faker->sentence(3),
            'descrizione' => $this->faker->optional()->paragraph(),
            'completata' => $this->faker->boolean(50), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
