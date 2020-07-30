<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title'=>$this->title,
            'type'=>$this->courseType->name,
            'image' => $this->image(),
            'description' => $this->description,
            'details' => $this->details,
            'price' => $this->price,
            'books_fees' => $this->books_fees,
            'min_age' => $this->min_age,
            'mook_exam' => $this->mook_exam,
            'duration' => $this->duration,
            'class_size' => $this->class_size,
            'weeks' => $this->weeks,
            'days' => $this->days,
            'hours' => $this->hours,
            'start' => $this->start,
            'time' => $this->time
        ];
    }
}
