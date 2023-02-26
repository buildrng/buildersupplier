<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRatings extends Model
{
    protected $table = 'product_rating';

    protected $fillable = ['pid','rate','msg','way','status'];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function Product()
    {
        return $this->belongsTo(Products::class,'pid');
    }

}
