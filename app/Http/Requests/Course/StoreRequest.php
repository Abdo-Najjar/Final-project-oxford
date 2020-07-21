<?php

namespace App\Http\Requests\Course;

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
            'type'=>'required|string|max:255',
            'image'=>'required|file|image|max:2000',
            'description'=>'required|string',
            'details'=>'required|string',
            'price'=>'required|numeric',
            'books_fees'=>'required|numeric',
            'min_age'=>'required|numeric',
            'level'=>'required|string|max:255',
            'mook_exam'=>'required|integer',
            'duration'=>'required|string|max:255',
            'class_size'=>'required||string|max:255',
            'weeks'=>'required||string|max:255',
            'days'=>'required|string|max:255',
            'hours'=>'required|integer',
            'start'=>'required|string|max:255',
            'time' =>'required|date_format:H:i'
        ];
    }
}
