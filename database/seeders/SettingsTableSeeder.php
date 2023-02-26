<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::truncate();

        Settings::create([
            'currencySymbol'=> '₦',
            'currencySide'=> 'left',
            'currencyCode'=> 'NGN',
            'appDirection'=> 'ltr',
            'logo'=> 'NA',
            'sms_name'=> 'twillio',
            'sms_creds' => '100',
            'delivery' => 1,
            // 'findType' => '',
            'makeOrders' => 1,
            // 'reset_pwd' => '',
            // 'user_login' => '',
            // 'store_login' => '',
            // 'user_verify_with' => '',
            // 'search_radius' => '',
            // 'driver_login' => '',
            // 'web_login' => '',
            // 'login_style' => '',
            // 'register_style' => '',
            // 'home_page_style_app' => '',
            'country_modal' => '', // text
            'web_category' => '', // text
            'default_country_code'=> 'NIG', // string
            'default_city_id'=> '4', // string
            'default_delivery_zip'=> '234', // string
            // 'social' => '', // text
            'app_color' => '', // text
            // 'app_status' => '', //tinyinteger
            // 'driver_assign' => 1, // tinyinteger
            // 'fcm_token' => '', //text
            'status' => 1, // tinyinteger
        ]);
    }
}
