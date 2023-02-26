<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
    protected $table = 'chat_message';

    protected $fillable = [
        'room_id',
        'uid',
        'from_id',
        'message',
        'timestamp',
        'message_type',
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

    public function Staff()
    {
        return $this->belongsTo(User::class,'from_id');
    }

    public function Room()
    {
        return $this->belongsTo(ChatRooms::class,'room_id');
    }

}
