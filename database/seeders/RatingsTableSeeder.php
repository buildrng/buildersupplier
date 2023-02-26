<?php

namespace Database\Seeders;

use App\Models\Ratings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ratings::truncate();

        // Add Ratings

        Ratings::create([
            // 'uid' => '',
            // 'pid' => '',
            // 'did' => '',
            'sid' => 1,
            'rate' => 3.00,
            'msg' => 'The store delayed my order',
            'way' => 'I do not understand what way in ratings mean',
            'status' => 1
        ]);
    }
}
