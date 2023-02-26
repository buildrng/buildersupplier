<?php

namespace Database\Seeders;

use App\Models\StoreRatings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreRatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreRatings::truncate();

        // Add StoreRatings

        StoreRatings::create([
            'sid' => 1,
            'rate' => 3.00,
            'msg' => 'The store delayed my order',
            'way' => 'I do not understand what way in ratings mean',
            'status' => 1
        ]);
    }
}
