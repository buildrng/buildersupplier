<?php

namespace Database\Seeders;

use App\Models\ChatRooms;
use Illuminate\Database\Seeder;

class ChatRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChatRooms::truncate();

        // Add ChatRooms

        ChatRooms::create([
            'uid' => 7,
            'participants' => '2',
            'status' => 1
        ]);
    
    }
}
