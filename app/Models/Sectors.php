<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sectors extends Model
{
    use \Sushi\Sushi;
    protected $rows = [
        [
            'abbr' => 'personal',
            'name' => 'Personal Construction',
            'status' => 1,
            'is_selected' => true,
            'is_default' => true
        ],
        [
            'abbr' => 'personal',
            'name' => 'Commercial & Industrial',
            'status' => 1,
            'is_selected' => false,
            'is_default' => false
        ],
        [
            'abbr' => 'indstrial',
            'name' => 'Govermental (Roads & bridges)',
            'status' => 1,
            'is_selected' => false,
            'is_default' => false
        ],
        [
            'abbr' => 'investors',
            'name' => 'Media & Investors',
            'status' => 1,
            'is_selected' => false,
            'is_default' => false
        ],
    ];
}
