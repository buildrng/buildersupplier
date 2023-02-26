<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffRatings extends Model
{
    protected $table = 'staff_rating';

    protected $fillable = ['uid','rate','msg','way','status'];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function Staff()
    {
        return $this->belongsTo(User::class,'uid');
    }

}
