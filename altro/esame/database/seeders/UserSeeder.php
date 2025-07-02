<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user1 = User::create([
            'name' => 'federico',
            'email' => 'federicosabbadini@icloud.com',
            'password' => Hash::make('sabbadini'), 
            'remember_token' => Str::random(10),
            'is_admin' => true,

        ]);

        DB::table('sessions')->insert([
            'id' => Str::uuid(),
            'user_id' => $user1->id,
            'payload' => '',
            'last_activity' => now()->timestamp,
        ]);

        $user2 = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('user'), 
            'remember_token' => Str::random(10),
            'is_admin' => false,

        ]);

        DB::table('sessions')->insert([
            'id' => Str::uuid(),
            'user_id' => $user2->id,
            'payload' => '',
            'last_activity' => now()->timestamp,
        ]);



        User::factory()->count(19)->create();
    }
}
