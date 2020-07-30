<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
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
            'days'=>$this->days,
            'time'=>$this->time,
            'major_of_study' =>$this->major_of_study,
            'how_knew_oxford'=> $this->how_knew_oxford,
            'notes'=>$this->notes,
            'permission_advertisment'=>$this->permission_advertisment,
            'national_number'=>$this->national_number,
            'type'=>$this->courseType->name
        ];

    }
}
