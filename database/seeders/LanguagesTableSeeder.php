<?php

namespace Database\Seeders;

use App\Models\Languages;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Languages::truncate();

        Languages::create([
            'name'            => 'English',
            'cover'           => '/assets/img/flags/gb.png', // string
            'content'         => '', // text
            'is_default'      => 1,
            'status'          => 1,
        ]);

        Languages::create([
            'name'            => 'French',
            'cover'           => '/assets/img/flags/fr.png', // string
            'content'         => '', // text
            'is_default'      => 0,
            'status'          => 1,
        ]);

        Languages::create([
            'name'            => 'Chinese',
            'cover'           => '/assets/img/flags/cn.png', // string
            'content'         => '', // text
            'is_default'      => 0,
            'status'          => 1,
        ]);

    }
}
