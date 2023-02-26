<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsTableSeeder::class);
        // $this->call(LanguagesTableSeeder::class);
        // $this->call(SettingsLanguagesTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(DriverUsersTableSeeder::class);
        $this->call(CustomerUsersTableSeeder::class);
        // $this->call(ProfilesTableSeeder::class);
        $this->call(VendorUsersTableSeeder::class);
        $this->call(StaffUsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(BankaccountsSeeder::class);
        // $this->call(PaymentsTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(PopupTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(AnalyticsTableSeeder::class);
        $this->call(ChatRoomsTableSeeder::class);
        $this->call(ChatMessagesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(FavouriteTableSeeder::class);
        $this->call(FlushTableSeeder::class);
        // $this->call(GeneralTableSeeder::class);
        $this->call(ManageTableSeeder::class);
        $this->call(OtpTableSeeder::class);
        // $this->call(ProfilesTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(RedeemTableSeeder::class);
        $this->call(ReferralCodesTableSeeder::class);
        $this->call(ReferralTableSeeder::class);
        $this->call(SubscriberTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        // $this->call(sTableSeeder::class);
    }
}
