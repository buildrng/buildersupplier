<?php

namespace Database\Seeders;

use App\Models\ReferralCodes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReferralCodes::truncate();

        // Add ReferralCodes

        ReferralCodes::create([
            'uid' => 3,
            'code' => '1234',
            'status' => 1
        ]);
    }
}
