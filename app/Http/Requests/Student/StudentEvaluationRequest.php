<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentEvaluationRequest extends FormRequest
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
            'speaking' => 'required|numeric|integer|min:0|max:10',
            'writing' => 'required|numeric|integer|min:0|max:10',
            'conversation' => 'required|numeric|integer|min:0|max:10',
            'reading' => 'required|numeric|integer|min:0|max:10',
            'vocabulary' => 'required|numeric|integer|min:0|max:10',
            'grammar' => 'required|numeric|integer|min:0|max:10',
            'notes' => 'nullable|string'
        ];
    }
}
