<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherEvaluationResrouce extends JsonResource
{

    public function __construct()
    {
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'topicFamiliariy'=>random_int(5,10),
            'communicateInfo'=>random_int(5,10),
            'presentationMethod'=>random_int(5,10),
            'explainContent'=>random_int(5,10),
            'cooperation'=>random_int(5,10),
            'varietyOfMethod'=>random_int(5,10),
            'abilityOfMotivation'=>random_int(5,10),
            'abilityOfDiscussion'=>random_int(5,10)

        ];
    }
}
