<?php

namespace App\Model;

use App\Model;
use App\User;

class Drug extends Model
{
    protected $table = 'drugs';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'price',
        'img',
        'type',
        'has',
        'use',
        'provider',
        'description',
    ];

}
