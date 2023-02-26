<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referral';



    protected $fillable = ['amount','title','message','limit','who_received','status'];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'who_received' => 'integer'
    ];

    public function WhoReceived()
    {
        return $this->belongsTo(User::class,'who_received');
    }
}
