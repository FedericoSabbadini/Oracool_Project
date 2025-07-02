<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'punteggio' => $this->faker->numberBetween(1, 5),
            'commento' => $this->faker->text(200),
            'user_id' => $this->faker->numberBetween(1, 20), // Assuming user IDs are between 1 and 20
            'hotel_id' => $this->faker->numberBetween(1, 10), // Assuming hotel IDs are between 1 and 10
        ];
    }
}
