<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'email' => 'chemuelgodes@gmail.com',
            'role' => 'Admin',
            'password' => '$2y$10$9sWOcPay9j9Uj8SXZPGCO.eWujfbfbma.E9aSjD92/xoiB0rkO4L6',
            'created_at' => '2023-10-17 00:00:00',
        ]);

        DB::table('profiles')->insert([
            'name' => 'Chemuel Castillo',
            'age' => '23',
            'gender' => 'Male',
            'position' => 'Website Consultant',
            'department' => 'Non-teaching',
            'phone_number' => '09631198435',
            'images' => 'xxxx',
            'user_id' => '1'
        ]);
    }
}
