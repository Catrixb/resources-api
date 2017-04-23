<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name'];

    protected $attributes = [
        'name' => 'none',
        'token' => 0,
    ];
}
