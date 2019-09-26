<?php

namespace App\Model;

use App\Model;
use App\User;

class OnlineMessage extends Model
{
    protected $table = 'online_message';

    protected $dates = ['published_at', 'created_at'];

    protected $fillable = [
        'id',
        'user_id',
        'doctor_id',
        'tell_id',
        'message',
        'room_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function doctor()
    {
        return $this->hasOne(User::class,'id','doctor_id');
    }
}
