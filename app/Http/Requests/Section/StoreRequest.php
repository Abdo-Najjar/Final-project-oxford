<?php

namespace App\Http\Requests\Section;

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
         'course_id'=>'required|exists:courses,id',
         'user_id'=>'required|exists:users,id',
         'start_at'=>'date|before_or_equal:end_at',
         'end_at'=>'date|after_or_equal:start_at'
        ];
    }
}
