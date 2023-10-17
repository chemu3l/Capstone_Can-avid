<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d');

        DB::table('users')->insert([
            'email' => 'chemuelgodes@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('chemuelgodes13'),
            'created_at' => $currentDate,
        ]);
        DB::table('profiles')->insert([
            'name' => 'Chemuel Castillo',
            'age' => '23',
            'gender' => 'Male',
            'position' => 'Website Consultant',
            'department' => 'Non-teaching',
            'phone_number' => '9631198435',
            'images' => 'images/profile_pictures/sby1FH3uhgpJkQ3yDtDiEQlB59hy3SaiHGkzOd8b.jpg'
        ]);
    }
}
