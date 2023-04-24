<?php

namespace Database\Seeders;

use App\Models\Brands;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brands::truncate();

        // Add ``Brands

        Brands::create([
            'uid' => 1,
            'name'  => 'Dangote',
            'logo'  => 'brands/dangote.png',
            'slogan'  => '',
            'link'  => 'http://www.dangote.com',
            'status' => 1
        ]);

        Brands::create([
            'uid' => 1,
            'name'  => 'LaFarge',
            'logo'  => 'brands/lafarge.png',
            'slogan'  => '',
            'link'  => 'http://www.lafarge.com',
            'status' => 1
        ]);
        
        Brands::create([
            'uid' => 1,
            'name'  => 'BUA group',
            'logo'  => 'brands/bua.jpg',
            'slogan'  => '',
            'link'  => 'http://www.buagroup.com',
            'status' => 1
        ]);
    }
}
