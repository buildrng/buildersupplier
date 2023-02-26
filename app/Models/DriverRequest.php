<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverRequest extends Model
{
    protected $table = 'driver_request';



    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'country_code',
        'mobile',
        'cover',
        'lat',
        'lng',
        'gender',
        'city',
        'address',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'gender' => 'integer',
    ];
}
