<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
        $this->populateDB();
    }

    private function populateDB()
    {

        // Create 100 authors
        Author::factory()->count(100)->create();

        // Randomly select a subset of 50 authors and, for each of them, create a set of books (from 1 to 5, randomly generated)
        $authors = Author::all();
        $authorsWithBooks = $authors->random(50);

        foreach($authorsWithBooks as $singleAuthor) {
            $numberOfBooks = rand(1,5);
            for($b=0; $b<$numberOfBooks; $b++) {
                Book::factory()->count(1)->create(['author_id' => $singleAuthor->id]);
            }
        }
    }
}
