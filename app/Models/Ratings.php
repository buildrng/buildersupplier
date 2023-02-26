<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $table = 'rating';



    protected $fillable = ['uid','pid','did','sid','rate','msg','way','status'];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'uid');
    }

    public function Product()
    {
        return $this->belongsTo(Products::class,'pid');
    }

    public function Driver()
    {
        return $this->belongsTo(User::class,'did');
    }
    
    public function Store()
    {
        return $this->belongsTo(Stores::class,'sid');
    }

}
