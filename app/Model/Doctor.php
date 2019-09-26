<?php

namespace App\Model;

use App\Model;

class Doctor extends Model
{
    protected $table = 'users_doctors';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'good_at',
        'service_time',
        'department'
    ];

}
