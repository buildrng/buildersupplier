<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'city_id',
        'store_id',
        'cover',
        'position',
        'link',
        'type',
        'message',
        'from',
        'to',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'position' => 'integer',
        'type' => 'integer',
    ];

    public function City()
    {
        return $this->belongsTo(Cities::class,'city_id');
    }

    public function Store()
    {
        return $this->belongsTo(Stores::class,'store_id');
    }
}
