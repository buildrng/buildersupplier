<?php

namespace Database\Seeders;

use App\Models\Stores;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stores::truncate();

        // Add Stores

        Stores::create([
            'uid' => 5,
            'name' => 'Main vendor',
            'slug' => 'main-vendor',
            'mobile' => '+234128804466',
            'lat' => '6.6465427',
            'lng' => '3.2446256',
            'verified' => 1,
            'address' => '7 Adebayo Abimbola Close, Amikale, Alagbado, Lagos',
            'descriptions' => 'Building Materials Company',
            // 'images' => '',
            'cover' => 'stores/store.jpg',
            'commission' => 0.5,
            'open_time' => '5:00:00', // hh:mm:ss time format
            'close_time' => '18:00:00', // hh:mm:ss time format
            'isClosed' => 1, // Store is opened=1, closed=0
            // 'certificate_url' => '',
            'certificate_type' => 'vendor',
            'rating' => 5.00,
            'total_rating' => 25,
            'cid' => 4,
            'zipcode' => '23401',
            'status' => 1
        ]);
    }
}
