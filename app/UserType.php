<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{


    const STUDENT = 1;

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
