<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descrizione' => fake()->text(200),
            'nome' => fake()->company(),
            'localita' => fake()->city(),
            'immagine' => "hotelExample.jpg",
        ];
    }
}
