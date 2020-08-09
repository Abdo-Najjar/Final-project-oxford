<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentEvaluationRequest;
use App\Http\Resources\GeneralResource;
use App\Section;
use App\StudentEvaluation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EvaluationController extends Controller
{

  public function evaluateStudent(StudentEvaluationRequest $request, User $user, Section $section)
  {

    if ($section->students->where('id', $user->id)->isEmpty()) {

      return response()->json(['message' => 'this user not regiester in this section'])->setStatusCode(Response::HTTP_EXPECTATION_FAILED);
    }


    return new GeneralResource(StudentEvaluation::updateOrCreate(['user_id' => $user->id, 'section_id' => $section->id], $request->validated()));
  }



  public function showStudentEvaluation()
  {
  }
}
