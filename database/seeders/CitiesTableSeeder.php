<?php

namespace Database\Seeders;

use App\Models\Cities;
use Illuminate\Database\Seeder;


class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cities::truncate();

        Cities::create([
            'name' => 'VI Lagos',
            'code' => '101241',
            'slug' => 'vi-lagos',
            'lat' => '6.4281',
            'lng' => '3.4219',
        ]);
        Cities::create([
            'name' => 'Lekki Lagos',
            'slug' => 'lekki-lagos',
            'lat' => '0',
            'lng' => '0',
        ]);
        Cities::create([
            'name' => 'Ajah Lagos',
            'slug' => 'ajah',
            'lat' => '0',
            'lng' => '0',
        ]);
        Cities::create([
            'name' => 'Ikeja Lagos',
            'slug' => 'ikeja',
            'lat' => '0',
            'lng' => '0',
        ]);
        Cities::create([
            'name' => 'Gbagada Lagos',
            'slug' => 'gbagada',
            'lat' => '0',
            'lng' => '0',
        ]);
        Cities::create([
            'name' => 'Idumota Lagos',
            'slug' => 'idumota',
            'lat' => '0',
            'lng' => '0',
        ]);
    }
}
