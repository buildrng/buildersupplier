<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRooms extends Model
{
    protected $table = 'chat_room';

    protected $fillable = [
        'uid',
        'participants',
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
