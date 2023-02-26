<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $table = 'redeem';



    protected $fillable = ['owner','redeemer','code','status'];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function Owner()
    {
        return $this->belongsTo(User::class,'owner');
    }

    public function Redeemer()
    {
        return $this->belongsTo(User::class,'redeemer');
    }
}
