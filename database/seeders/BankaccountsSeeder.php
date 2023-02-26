<?php

namespace Database\Seeders;

use App\Models\Bankaccounts;
use Illuminate\Database\Seeder;

class BankaccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add Bank Accounts
        Bankaccounts::truncate();

        Bankaccounts::create([
            'name'              => 'Fidelity',
            'number'            => '655-924-223',
            'holder'       => 'David Nnachi Egwu (personal Account - remove this)',
            'type'              => 'savings',
            'status'          => 1,
        ]);

        Bankaccounts::create([
            'name'              => 'Polaris',
            'number'            => '655-924-223',
            'holder'       => 'David Nnachi (personal Account - remove this)',
            'type'              => 'savings',
            'status'          => 1,
        ]);
    }
}
