<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flush extends Model
{
    protected $table = 'flush';



    protected $fillable = [
        'key',
        'value',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];
}
