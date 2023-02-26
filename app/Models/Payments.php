<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';



    protected $fillable = [
        'name',
        'env',
        'status',
        'currency_code',
        'cover',
        'creds'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'creds'
    ];

    protected $casts = [
        'status' => 'integer',
        'env' => 'integer'
    ];
}
