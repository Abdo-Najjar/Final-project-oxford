<?php

namespace App\Http\Controllers;

use App\CourseType;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\SectionResource;
use App\Http\Resources\UserResource;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function apiLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->token = "Bearer {$user->createToken($request->device_name)->plainTextToken}";

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'logout successfuly']);
    }

    public function logoutFromAllDevices(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'logout successfuly']);
    }

    public function user(User $user)
    {
        return new UserResource($user);
    }


    public function store(StoreRequest $request)
    {

        $data =  $request->validated();

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);


        $user->userInfo()->create($data);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }


    public function teachers()
    {
        return UserResource::collection(User::orderByDesc('updated_at')->where('usertype_id', User::TEACHER_TYPE)->paginate(app('pagination_value')));
    }


    public function students()
    {
        return UserResource::collection(User::orderByDesc('updated_at')->where('usertype_id', User::STUDENT_TYPE)->paginate(app('pagination_value')));
    }

    public function studentsInCourseType(CourseType $courseType)
    {

        return  UserResource::collection(User::whereHas('userInfo', function ($userInfo) use ($courseType) {

            $userInfo->where('course_type_id', $courseType->id);
        })->paginate(app('pagination_value')));
    }


    public function studentsInSection(Section $section)
    {
        return  UserResource::collection($section->students()->orderByDesc('updated_at')->paginate(app('pagination_value')));
    }

    public  function sections()
    {

        return SectionResource::collection(auth()->user()->sections()->orderByDesc('updated_at')->paginate(app('pagination_value')));
    }

    public function myClasses()
    {
        return SectionResource::collection(auth()->user()->classes()->orderByDesc('updated_at')->paginate(app('pagination_value')));
    }
}
