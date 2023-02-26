<?php

namespace Database\Seeders;

use App\Models\Contacts;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contacts::truncate();

        // Add Contacts

        // Contacts::create([
        //     'name' => 'John Doe',
        //     'email' => 'john@doe.com',
        //     'message' => 'New Contact',
        //     'date' => Carbon::now()->subDays(2),
        //     'status' => 1
        // ]);
    }
}
