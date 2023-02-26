<?php

namespace Database\Seeders;

use App\Models\Favourite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavouriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favourite::truncate();

        // Add Favourite

        Favourite::create([
            'uid' => 3,
            'ids' => '{1,2}',
            'status' => 1
        ]);
    }
}
