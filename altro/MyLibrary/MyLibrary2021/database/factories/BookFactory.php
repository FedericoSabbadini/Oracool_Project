<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
    */

    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(1, 5)),
        ];
    }
}
