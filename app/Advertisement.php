<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    
    protected $guarded = [];

    public function getImageAttribute($attribue)
    {
        return env('APP_URL').'/advertisements/'.$attribue;
    }
}
