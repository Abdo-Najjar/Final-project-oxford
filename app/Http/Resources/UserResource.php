<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;
use SebastianBergmann\CodeUnitReverseLookup\Wizard;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'token' => $this->when(Request::segment(3) == 'token', $this->token),
            'type' => $this->userType->type,
            'phone_number' => $this->phone_number,
            'email'=>$this->email,
            'dob' => $this->dob,
            'address' => $this->address,
            'gender' => $this->gender,
            'idn' => $this->when(Request::segment(2) != 'teachers', $this->idn),
            'details'=> new UserInfoResource($this->userInfo)
            // 'details' => $this->when(Request::segment(2) != 'teachers' and $this->usertype_id == User::STUDENT_TYPE, new UserInfoResource($this->userInfo)),
        ];
    }
}
