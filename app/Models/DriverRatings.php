<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverRatings extends Model
{
    protected $table = 'driver_rating';

    protected $fillable = ['uid','rate','msg','way','status'];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function Driver()
    {
        return $this->belongsTo(User::class,'uid');
    }
}
