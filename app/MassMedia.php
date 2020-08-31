<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MassMedia extends Model
{

    protected $guarded = [];

    public const MEDIA_VEDIO_TYPE = '0';
    
    public const MEDIA_AUDIO_TYPE = '1';

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }


}
