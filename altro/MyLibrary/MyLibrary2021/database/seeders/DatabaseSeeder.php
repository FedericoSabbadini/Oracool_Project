<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LibUser;
use App\Models\DataLayer;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        LibUser::create([
            'username' => 'devis',
            'email' => 'devis.bianchini@unibs.it',
            'password' => md5('bianchini')
        ]);

        LibUser::create([
            'username' => 'alessandro',
            'email' => 'abianchini@icbovezzo.edu.it',
            'password' => md5('bianchini')
        ]);

        $dl = new DataLayer();
        $user1 = $dl->getUserID('devis');
        $user2 = $dl->getUserID('alessandro');

        /* 
        Author::factory()->count(10)->create(['user_id' => $user1])->each(function ($author) {
            Book::factory()->count(10)->create(['author_id' => $author->id, 'user_id' => $author->user_id]);
        });

        Author::factory()->count(10)->create(['user_id' => $user2])->each(function ($author) {
            Book::factory()->count(10)->create(['author_id' => $author->id, 'user_id' => $author->user_id]);
        }); 
        */

        Author::factory()->count(100)->create(['user_id' => $user1]);
        $authors_list1 = json_decode($dl->listAuthors($user1));

        for ($i = 0; $i < 50; $i++) {
            $author = $authors_list1[array_rand($authors_list1)];
            Book::factory()->count(1)->create(['author_id' => $author->id, 'user_id' => $author->user_id]);
        }

        Author::factory()->count(100)->create(['user_id' => $user2]);
        $authors_list2 = json_decode($dl->listAuthors($user2));

        for ($i = 0; $i < 50; $i++) {
            $author = $authors_list2[array_rand($authors_list2)];
            Book::factory()->count(1)->create(['author_id' => $author->id, 'user_id' => $author->user_id]);
        }
    }
}
