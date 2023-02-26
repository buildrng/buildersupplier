<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $table = 'store';

    protected $fillable = [
        'uid',
        'name',
        'mobile',
        'lat',
        'lng',
        'verified',
        'address',
        'descriptions',
        'images',
        'cover',
        'commission',
        'open_time',
        'close_time',
        'isClosed',
        'certificate_url',
        'certificate_type',
        'rating',
        'total_rating',
        'cid',
        'zipcode',
        'status'
    ];

    protected $casts = [
        'status' => 'integer',
        'verified' => 'integer',
        'isClosed' => 'integer',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'commission'
    ];

    // public with = city;

    public function Owner()
    {
        return $this->belongsTo(User::class,'uid','id');
    }

    public function City()
    {
        return $this->belongsTo(Cities::class,'cid','id');
    }
}
