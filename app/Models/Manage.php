<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manage extends Model
{
    protected $table = 'manage';



    protected $fillable = [
        'app_close',
        'message',
        'date_time',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'app_close' => 'integer',
    ];
}
