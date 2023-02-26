<?php

namespace Database\Seeders;

use App\Models\Manage;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manage::truncate();

        // Add Manage

        Manage::create([
            'app_close' => 1,
            'message' => 'Builder App',
            'date_time' => Carbon::now()->addCenturies(3),
            'status' => 1
        ]);
    }
}
