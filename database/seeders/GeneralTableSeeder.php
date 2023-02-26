<?php

namespace Database\Seeders;

use App\Models\General;
use Illuminate\Database\Seeder;

class GeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        General::truncate();

        // Add general settings

        General::create([
            'name' => 'Builder',
            'mobile' => '2348128804466',
            'email' => 'buildrng@gmail.com',
            'address' => '7a Adebayo Close, Amikale',
            'city' => 'Alagbado',
            'state' => 'Lagos',
            'zip' => '23401',
            'country' => 'Nigeria',
            'min' => 2000.00,
            'free' =>200000.00,
            'tax' => 10.00,
            'shipping' => 'Truck',
            'shippingPrice' => 40.00,
            'status' => 1
        ]);
    }
}
