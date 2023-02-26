<?php

namespace Database\Seeders;

use App\Models\Referral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Referral::truncate();

        // Add Referral

        Referral::create([
            'amount' => 3000.00,
            'title' => 'Refer & Win N3000',
            'message' => 'To win just refer a friend or colleage, who signs up',
            'limit' => 3,
            'who_received' => 3,
            'status' => 1
        ]);
    }
}
