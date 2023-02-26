<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add customers
        $customer = User::create([
            'first_name' => 'Customer',
            'last_name' => 'User',
            'email' => 'customer@builder.test',
            'password' => bcrypt('password'),
            'mobile' => '8128804463',
            'type' => 'customer'
        ]);

        $customer->deposit(10000);

        $david = User::create([
            'first_name' => 'David',
            'last_name' => 'Nnachi',
            'email' => 'cxcube.clients@gmail.com',
            'password' => bcrypt('mufasa32'),
            'mobile' => '8166634797',
            'type' => 'customer'
        ]);

        $david->deposit(10000);
    }
}
