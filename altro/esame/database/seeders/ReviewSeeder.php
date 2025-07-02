<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Hotel;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = Hotel::all();
        $users = User::all();

        foreach ($users as $user) {
            if (!$user->is_admin) {
                
                $hotel = $hotels->random(3);

                foreach ($hotel as $hotel) {
                    Review::factory()->create([
                        'hotel_id' => $hotel->id,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }
}