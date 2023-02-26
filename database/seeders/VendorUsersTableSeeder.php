<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class VendorUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Vendors

        User::create([
            'first_name' => 'Vendor',
            'last_name' => 'User',
            'email' => 'vendor@builder.test',
            'password' => bcrypt('password'),
            'mobile' => '8128804464',
            'type' => 'vendor'
        ]);
    }
}
