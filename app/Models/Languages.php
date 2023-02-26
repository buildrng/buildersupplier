<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    use \Sushi\Sushi;

    protected $rows = [
        [
            'abbr' => 'en',
            'name' => 'English 🇬🇧',
            'status' => 1,
            'is_selected' => true,
            'is_default' => true
        ],
        [
            'abbr' => 'fr',
            'name' => 'Français 🇫🇷',
            'status' => 1,
            'is_selected' => false,
            'is_default' => false
        ],
        [
            'abbr' => 'cn',
            'name' => '中国人 - 🇨🇳',
            'status' => 1,
            'is_selected' => false,
            'is_default' => false
        ],
        [
            'abbr' => 'ar',
            'name' => '>عربى - 🇸🇦',
            'status' => 1,
            'is_selected' => false,
            'is_default' => false
        ],
        // [
        //     'abbr' => 'sw',
        //     'name' => 'Swahili',
        //     'status' => 1,
        //     'is_selected' => false,
        //     'is_default' => false
        // ],
    ];
}
