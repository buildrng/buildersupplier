<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreRequest extends Model
{
    protected $table = 'store_request';



    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'mobile',
        'country_code',
        'cover',
        'lat',
        'lng',
        'address',
        'name',
        'descriptions',
        'open_time',
        'close_time',
        'cid',
        'zipcode',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'status' => 'integer',
    ];
}
