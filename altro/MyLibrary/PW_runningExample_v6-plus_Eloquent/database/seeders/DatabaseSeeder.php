<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->populateDB();
    }

    private function populateDB()
    {

        // Create 100 authors with their corresponding address
        Author::factory()->count(100)->create()->each(function ($author) {
            Address::factory()->count(1)->create(['author_id' => $author->id]);
        });

        // Randomly select a subset of 50 authors and, for each of them, create a set of books (from 1 to 5, randomly generated)
        $authors = Author::all();
        $authorsWithBooks = $authors->random(50);

        foreach($authorsWithBooks as $singleAuthor) {
            $numberOfBooks = rand(1,5);
            for($b=0; $b<$numberOfBooks; $b++) {
                Book::factory()->count(1)->create(['author_id' => $singleAuthor->id]);
            }
        }

        // Create 10 book categories
        Category::factory()->count(1)->create(['name' => 'Romanzi classici']);
        Category::factory()->count(1)->create(['name' => 'Fantasy']);
        Category::factory()->count(1)->create(['name' => 'Gialli']);
        Category::factory()->count(1)->create(['name' => 'Thriller']);
        Category::factory()->count(1)->create(['name' => 'Saggi']);
        Category::factory()->count(1)->create(['name' => 'Poesie']);
        Category::factory()->count(1)->create(['name' => 'Psicologia']);
        Category::factory()->count(1)->create(['name' => 'Fantascienza']);
        Category::factory()->count(1)->create(['name' => 'Viaggi']);
        Category::factory()->count(1)->create(['name' => 'Arte e fotografia']);

        // Randomly associate a book to a subset of categories (from 1 to 5)
        $books = Book::all();
        $categories = Category::all();

        foreach($books as $singleBook)
        {
            $numberOfCategories = rand(1,5);
            $selectedCategories = $categories->random($numberOfCategories);
            $singleBook->categories()->attach($selectedCategories);
        }
    }
}
