<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscriber::truncate();

        // Add Subscriber

        // Subscriber::create([
        //     'email' => 'john@doe.com',
        //     'status' => 1
        // ]);
    }
}
