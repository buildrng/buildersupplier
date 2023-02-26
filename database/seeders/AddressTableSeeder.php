<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::truncate();

        // Add Address

        Address::create([
            'uid' => 3,
            'title' => 'Site',
            'address' => '123 Customer Site, Street, Ikeja, Lagos',
            'house' => '123',
            'landmark' => 'Customer Bus-stop',
            'pincode' => '1234',
            'lat' => '0.234',
            'lng' => '2.234',
            'status' => 1
        ]);

        Address::create([
            'uid' => 4,
            'title' => 'Site',
            'address' => '123 Customer Site, Street, Ikeja, Lagos',
            'house' => '123',
            'landmark' => 'Customer Bus-stop',
            'pincode' => '1234',
            'lat' => '0.234',
            'lng' => '2.234',
            'status' => 1
        ]);

    }
}
