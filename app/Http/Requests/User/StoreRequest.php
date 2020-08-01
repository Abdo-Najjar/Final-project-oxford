<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>'required|string|max:255' ,
            'last_name' =>'required|string|max:255',
            'password'=>'required|string|max:255|min:6',
            'email' =>'required|email|max:255|unique:users,email',
            'dob' =>'required|date_format:Y-m-d',
            'phone_number'=>'required|regex:/(05)[0-9]{8}/',
            'days'=>'required|string|max:255',
            'time'=>'required|date_format:H:i',
            'major_of_study'=>'required|string|max:255',
            'how_knew_oxford'=>'nullable|string',
            'notes'=>'nullable|string',
            'permission_advertisment'=>'boolean',
            'national_number'=>'required|numeric',
            'course_type_id'=>'required|exists:course_types,id',
            'usertype_id'=>'required|exists:user_types,id'
        ];
    }
}
