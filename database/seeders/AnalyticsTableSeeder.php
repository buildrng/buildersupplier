<?php

namespace Database\Seeders;

use App\Models\Analytics;
use Illuminate\Database\Seeder;

class AnalyticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Analytics::truncate();

        // Add Analytics

        Analytics::create([
            'analytics' => '',
            'ip' => '100.1.0.0.1',
        ]);

    }
}
