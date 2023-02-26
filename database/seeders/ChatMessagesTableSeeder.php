<?php

namespace Database\Seeders;

use App\Models\ChatMessages;
use Illuminate\Database\Seeder;

class ChatMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChatMessages::truncate();

        // Add Chatmessages

        ChatMessages::create([
            'room_id' => 1,
            'uid' => 3,
            'from_id' => 7,
            'message' => 'hi',
            'message_type' => 'chat',
            'status' => 1
        ]);
    }
}
