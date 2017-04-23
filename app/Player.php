<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['id'];

    public function toArray()
    {
        return array_merge(['id' => 0, 'token' => 0], parent::toArray());
    }
}
