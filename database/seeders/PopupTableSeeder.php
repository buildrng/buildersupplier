<?php

namespace Database\Seeders;

use App\Models\Popup;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now()->addDays(31);
        Popup::truncate();

        // Add Popups

        Popup::create([
            'title' => 'first timer',
            'message' => 'first time Customer discount, 6% Off total price',
            'shown' => 1,
            'date_time' => $time,
            'status' => 1
        ]);
    }
}
