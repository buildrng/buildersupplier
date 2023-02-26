<?php

namespace Database\Seeders;

use App\Models\StaffRatings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffRatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StaffRatings::truncate();

        // Add StaffRatings

        StaffRatings::create([
            'uid' => 4,
            'rate' => 3.00,
            'msg' => 'The staff delayed my order',
            'way' => 'I do not understand what way in ratings mean',
            'status' => 1
        ]);
    }
}
