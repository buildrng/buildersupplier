<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $table = 'complaints';



    protected $fillable = [
        'uid',
        'order_id',
        'issue_with',
        'driver_id',
        'store_id',
        'product_id',
        'reason_id',
        'title',
        'short_message',
        'images',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'issue_with' => 'integer',
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'uid');
    }

    public function Order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function Store()
    {
        return $this->belongsTo(Stores::class,'store_id');
    }

    public function Driver()
    {
        return $this->belongsTo(Drivers::class,'driver_id');
    }

    public function Product()
    {
        return $this->belongsTo(Products::class,'id','product_id');
    }


    // public function Store()
    // {
    //     return $this->belongsTo(User::class,'id','uid');
    // }
}
