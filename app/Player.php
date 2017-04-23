<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name'];

    public function toArray()
    {
        return array_merge(['name' => 'none', 'token' => 0], parent::toArray());
    }
}
