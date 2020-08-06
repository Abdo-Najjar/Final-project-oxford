<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
class Section extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::created(function ($section) {

            $section->name = Carbon::now()->year . $section->course->courseType->name . 'S' . $section->id . 'C' . $section->course->id;

            $section->save();
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
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    
    public function students()
    {
        return $this->belongsToMany(User::class)->withPivot(['book_fees' , 'course_fees'])->withTimestamps();
    }

    /**
     * assign student to class or section
     *
     * @param User $user
     *
     * @return void
     */
    public function assignStudent(User $user)
    {
        if ($user->usertype_id != User::STUDENT_TYPE) {
            throw  new Exception('Only students can be assign to section!');
        }

        $this->students()->syncWithoutDetaching($user->id);
    }

    /**
     * fire student from class (Section)
     *
     * @param User $user
     *
     * @return void
     */
    public function fireStudent(User $user)
    {
        if ($user->usertype_id != User::STUDENT_TYPE) {
            throw new Exception('Only students can be fire to section!');
        }

        $this->students()->detach($user->id);
    }
}
