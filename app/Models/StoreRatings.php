<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreRatings extends Model
{
    protected $table = 'store_rating';

    protected $fillable = ['sid','rate','msg','way','status'];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];
    
    public function Store()
    {
        return $this->belongsTo(Stores::class,'sid');
    }

}
