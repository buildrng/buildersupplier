<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Banners;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banners::truncate();

        // Add Banners

        Banners::create([
            'city_id' => 4,
            'store_id' => 1,
            'cover' => 'banners/banner-01.jpg',
            'position' => 0,
            'link' => '/dangote-promo',
            // 'type' => 1,
            'message' => 'Now Selling : Dangote Cement',
            'from' => Carbon::now()->subDays(1),
            'to' => Carbon::now()->addDays(31),
            'status' => 1
        ]);
    }
}
