<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'uid',
        'title',
        'address',
        'house',
        'landmark',
        'pincode',
        'lat',
        'lng',
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
