<?php

namespace Database\Seeders;

use App\Models\Pages;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pages::truncate();
        Pages::create([
            'name'              => 'About us',
            'content'           => 'About us',
            'status'            => 1
        ]);

        Pages::create([
            'name'              => 'Privacy',
            'content'           => 'Privacy',
            'status'            => 1
        ]);

        Pages::create([
            'name'              => 'Terms & Conditions',
            'content'           => 'Terms & Conditions',
            'status'            => 1
        ]);

        Pages::create([
            'name'              => 'Refund Policy',
            'content'           => 'Refund Policy',
            'status'            => 1
        ]);

        Pages::create([
            'name'              => 'Frequently Asked Questions',
            'content'           => 'Frequently Asked Questions',
            'status'            => 1
        ]);

        Pages::create([
            'name'              => 'Help',
            'content'           => 'Help',
            'status'            => 1
        ]);

        Pages::create([
            'name'              => 'Legal Mentions',
            'content'           => 'Legal Mentions',
            'status'            => 1
        ]);

        Pages::create([
            'name'              => 'Cookies',
            'content'           => 'Cookies',
            'status'            => 1
        ]);
    }
}
