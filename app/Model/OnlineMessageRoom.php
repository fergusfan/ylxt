<?php

namespace App\Model;

use App\Model;
use App\User;

class OnlineMessageRoom extends Model
{
    protected $table = 'online_message_room';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'doctor_id',
    ];

    public function message()
    {
        return $this->hasMany(OnlineMessage::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function doctor()
    {
        return $this->hasOne(User::class,'id','doctor_id');
    }
}
