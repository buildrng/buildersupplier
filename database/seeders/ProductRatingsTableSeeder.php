<?php

namespace Database\Seeders;

use App\Models\ProductRatings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductRatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductRatings::truncate();

        // Add ProductRatings

        ProductRatings::create([
            'pid' => 1,
            'rate' => 3.00,
            'msg' => 'The product is not what I expected',
            'way' => 'I do not understand what way in ratings mean',
            'status' => 1
        ]);
    }
}
