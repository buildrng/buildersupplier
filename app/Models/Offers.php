<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = 'offers';

    protected $fillable = [
        'name',
        'off',
        'type',
        'upto',
        'min',
        'from',
        'to',
        'descriptions',
        'date_time',
        'image',
        'manage',
        'store_id',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'manage' => 'integer',
    ];


    public function Store()
    {
        return $this->belongsTo(Stores::class,'id','store_id');
    }

    // public function Manage()
    // {
        // return $this->belongsTo(Stores::class,'id','store_id');
    // }
}
