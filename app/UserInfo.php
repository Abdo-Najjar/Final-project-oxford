<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    
    protected $fillable = [
        'course_type_id','days','time','major_of_study','how_knew_oxford','notes','permission_advertisment','national_number'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }


    public function getTimeAttribute($value)
    {
        return Carbon::make($value)->format('H:i');
    }
}
