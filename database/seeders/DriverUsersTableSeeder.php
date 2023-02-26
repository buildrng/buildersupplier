<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DriverUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add drivers
        User::create([
            'first_name' => 'Driver',
            'last_name' => 'User',
            'email' => 'driver@builder.test',
            'password' => bcrypt('password'),
            'mobile' => '08128804462',
            'type' => 'driver'
        ]);
    }
}
