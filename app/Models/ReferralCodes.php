<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralCodes extends Model
{
    protected $table = 'referralcodes';

    protected $fillable = [
        'uid',
        'code',
        'status'
    ];

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
}
