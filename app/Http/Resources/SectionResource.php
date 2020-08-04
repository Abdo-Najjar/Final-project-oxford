<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'type'=>$this->course->courseType->name ,
            'course_id'=>$this->course_id,
            'user_id'=>$this->user_id,
            'start_at'=>$this->start_at,
            'end_at'=>$this->end_at
        ];

        return parent::toArray($request);
    }
}
