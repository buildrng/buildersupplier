<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class StaffUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add staff

        User::create([
            'first_name' => 'Staff',
            'last_name' => 'User',
            'email' => 'staff@build.test',
            'password' => bcrypt('password'),
            'mobile' => '08128804465',
            'type' => 'staff'
        ]);

        // Add Marketing staff

        User::create([
            'first_name' => 'Marketing',
            'last_name' => 'Staff',
            'email' => 'marketingstaff@build.test',
            'password' => bcrypt('password'),
            'mobile' => '08128804466',
            'type' => 'staff'
        ]);

        // Add Support staff

        User::create([
            'first_name' => 'Support',
            'last_name' => 'Staff',
            'email' => 'supportstaff@build.test',
            'password' => bcrypt('password'),
            'mobile' => '08128804467',
            'type' => 'staff'
        ]);

        // Add Merchansing staff

        User::create([
            'first_name' => 'Merchansing',
            'last_name' => 'Staff',
            'email' => 'merchansingstaff@build.test',
            'password' => bcrypt('password'),
            'mobile' => '08128804468',
            'type' => 'staff'
        ]);
    }
}
