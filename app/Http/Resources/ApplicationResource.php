<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'first_name' =>$this->first_name,
            'last_name' =>$this->last_name,
            'gender' =>$this->gender,
            'email' =>$this->email,
            'address' =>$this->address,
            'dob' =>$this->dob,
            'phone_number' =>$this->phone_number,
            'days' =>$this->days,
            'time' =>$this->time,
            'major_of_study' =>$this->major_of_study,
            'recognize' =>$this->recognize,
            'notes' =>$this->notes,
            'picture_permission' =>$this->picture_permission,
            'national_number' =>$this->national_number,
            'type' => $this->courseType->name

        ];
    }
}
