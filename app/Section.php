<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::created(function($section){

            dd($section->name = Carbon::now()->year.$section->course->courseType->name.$section->id);
        });
    }

    /**
     * remove mass assingment 
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * elequant relation with course 
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     *elequant relation with user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
