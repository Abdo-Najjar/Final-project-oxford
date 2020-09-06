<?php

namespace App\Http\Controllers;

use App\User;
use App\Section;
use App\SectionEvaluation;
use App\StudentEvaluation;
use App\TeacherEvaluation;
use Illuminate\Http\Response;
use App\Http\Resources\GeneralResource;
use App\Http\Requests\Student\StudentEvaluationRequest;
use App\Http\Requests\Section\SectionEvaluationRequest;
use App\Http\Requests\TeacherEvaluationRequest;
use Illuminate\Support\Arr;

class EvaluationController extends Controller
{

  public function evaluateStudent(StudentEvaluationRequest $request, User $user, Section $section)
  {

    if ($section->students->where('id', $user->id)->isEmpty()) {

      return response()->json(['message' => 'this user not regiester in this section'])->setStatusCode(Response::HTTP_EXPECTATION_FAILED);
    }


    return new GeneralResource(StudentEvaluation::updateOrCreate(['user_id' => $user->id, 'section_id' => $section->id], $request->validated()));
  }



  public function showStudentEvaluation(User $user, Section $section)
  {
    return new GeneralResource(StudentEvaluation::where('user_id', $user->id)->where('section_id', $section->id)->first());
  }


  public function evaluateSection(SectionEvaluationRequest $request,  Section $section)
  {

    return new GeneralResource(SectionEvaluation::updateOrCreate(['user_id' => auth()->id(), 'section_id' => $section->id], $request->validated()));
  }


  public function evaluateTeacher(TeacherEvaluationRequest $request , User $user)
  {
    return new GeneralResource(TeacherEvaluation::Create(Arr::add($request->validated() , 'user_id' , $user->id)));
  }
}
