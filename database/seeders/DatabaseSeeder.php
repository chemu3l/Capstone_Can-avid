<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'chemuelgodes@gmail.com',
            'role' => 'Admin',
            'password' => '$2y$10$sVw3owNLZF1THoGfpdCvsu18JogmGYNVIDEL.MowdpKTgzSp6WVtG',
            'created_at' => now(),
        ]);

        DB::table('profiles')->insert([
            'name' => 'Chemuel Castillo',
            'age' => '23',
            'gender' => 'Male',
            'position' => 'Website Consultant',
            'department' => 'Consultant',
            'phone_number' => '09631198435',
            'images' => '',
            'user_id' => 1,
        ]);
    }
}
