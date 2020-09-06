<?php

namespace App\Http\Requests\Section;

use Illuminate\Foundation\Http\FormRequest;

class SectionEvaluationRequest extends FormRequest
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
        $rules = 'required|numeric|min:1|max:10';
        return [
            'speaking' => $rules,
            'converstion' => $rules,
            'reading' => $rules,
            'writing' => $rules,
            'vocab' => $rules,
            'english_speaking' => $rules,
            'commitment_time' => $rules

        ];
    }
}
