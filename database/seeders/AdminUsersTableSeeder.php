<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        // Add Admins

        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@builder.test',
            'password' => bcrypt('password'),
            'mobile' => '8128804461',
            'type' => 'admin'
        ]);
    }
}
