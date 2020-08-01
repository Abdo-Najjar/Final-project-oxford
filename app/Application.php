<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    protected $guarded = [];

    public function getPicturePermissionAttribute($attribute)
    {
        return $attribute ? "1" : "0";
    }

    public function getNationalNumberAttribute($attribute)
    {
        return strval($attribute);
    }
    
    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }
}
