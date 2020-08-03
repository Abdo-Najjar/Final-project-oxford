<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title'=>'required|string|max:255',
            'course_type_id'=>'required|exists:course_types,id',
            'image'=>'sometimes|file|image|max:2000',
            'description'=>'required|string',
            'details'=>'required|string',
            'price'=>'required|numeric',
            'books_fees'=>'required|numeric',
            'min_age'=>'required|numeric',
            'mook_exam'=>'required|integer',
            'duration'=>'required|string|max:255',
            'class_size'=>'required|integer',
            'weeks'=>'required|integer',
            'days'=>'required|string|max:255',
            'hours'=>'required|integer',
            'start'=>'required|string|max:255',
            'time' =>'required|date_format:H:i'
        ];
    }
}
