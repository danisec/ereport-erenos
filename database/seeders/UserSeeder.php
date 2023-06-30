<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        // Create static users
        User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'NIP' => '3412491256',
            'role' => '1',
            'email_verified_at' => now(),
            'password' => '$2y$10$S7mVpDf3vuf/gPSrdu3h1esdFwAyi/BaECp24cr2YqKTwEKEZl5WG', // password
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Guru',
            'username' => 'guru',
            'email' => 'guru@gmail.com',
            'NIP' => '3429494466',
            'role' => '0',
            'email_verified_at' => now(),
            'password' => '$2y$10$4R4iCegkys92Q0TTQJMc/.DGijqsHOuXgZTt4XDOygeJOdilEjqcO', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
