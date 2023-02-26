<?php

namespace Database\Seeders;

use App\Models\Flush;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlushTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flush::truncate();

        // Add Flush

        Flush::create([
            'key' => 'cache:clear',
            'value' => '-v',
            'status' => 1
        ]);
    }
}
