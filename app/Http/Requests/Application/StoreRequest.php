<?php

namespace App\Http\Requests\Application;

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
            'first_name' => 'required|string|max:255',
            'gender'=>'required||min:1|max:2',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'address' => 'required|string|max:255',
            'dob' => 'required|date_format:Y-m-d',
            'phone_number'=>'required|regex:/(05)[0-9]{8}/|size:10',
            'course_type_id' => 'required|exists:course_types,id',
            'days' => 'required|string|max:255',
            'time' => 'required|date_format:H:i',
            'major_of_study' => 'required|string|max:255',
            'recognize' => 'sometimes|string',
            'notes' => 'sometimes|string',
            'picture_permission' => 'required|boolean',
            'national_number' => 'required|numeric|digits_between:7,255',

        ];
    }


    public function attributes()
    {
        return [
            'dob' => 'date of birth',
        ];
    }

    

    
}
