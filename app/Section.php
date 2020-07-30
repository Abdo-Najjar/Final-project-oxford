<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

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
