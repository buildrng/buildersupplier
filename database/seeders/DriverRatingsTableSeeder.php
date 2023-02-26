<?php

namespace Database\Seeders;

use App\Models\DriverRatings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverRatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DriverRatings::truncate();

        // Add DriverRatings

        DriverRatings::create([
            'uid' => 2,
            'rate' => 3.00,
            'msg' => 'The driver delayed my order',
            'way' => 'I do not understand what way in ratings mean',
            'status' => 1
        ]);
    }
}
