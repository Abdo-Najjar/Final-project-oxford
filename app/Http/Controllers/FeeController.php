<?php

namespace App\Http\Controllers;

use App\Http\Requests\Fee\StoreRequest;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FeeController extends Controller
{

    public function addFee(StoreRequest $request,  User $user, Section $section)
    {

        if($section->students->where('id' , $user->id)->isEmpty()){

            return response()->json(['message' =>'this use not regiester in this section'])->setStatusCode(Response::HTTP_EXPECTATION_FAILED);
            

        }

        $section->students()->updateExistingPivot($user->id, ['book_fees' => $request->book_fees, 'course_fees' => $request->course_fees]);

        return response()->noContent();
    }
}
