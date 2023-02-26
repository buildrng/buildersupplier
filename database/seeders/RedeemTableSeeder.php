<?php

namespace Database\Seeders;

use App\Models\Redeem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RedeemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Redeem::truncate();

        // Add Redeem

        Redeem::create([
            'owner' => 6,
            'redeemer' => 3,
            'code' => '1234',
            'status' => 1
        ]);
    }
}
