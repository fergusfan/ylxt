<?php

namespace App\Model;

use App\Model;
use App\User;

class Advice extends Model
{
    protected $table = 'advice';


    protected $fillable = [
        'id',
        'user_id',
        'doctor_id',
        'message',
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
