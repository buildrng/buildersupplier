<?php

namespace Database\Seeders;

use App\Models\Otp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OtpTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Otp::truncate();

        // Add Otp

        // Otp::create([
        //     'otp' => '1234',
        //     'email' => 'john@doe.com',
        //     'status' => 1
        // ]);
    }
}
