<?php

namespace App\Model;

use App\Model;
use App\User;

class Order extends Model
{
    //预约挂号
    protected $table = 'orders';
    //
    protected $fillable = [
        'id',
        'user_id',
        'order_time',
        'description',
        'department',
        'order_replay'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
