<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CourseResource::collection(Course::paginate(app('pagination_value')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $course =  Course::create($request->except('image'));

        $course->addMediaFromRequest('image')
            ->toMediaCollection('images');

        return  response(new CourseResource($course), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        if ($request->hasFile('image')) {

            $course->clearMediaCollection('images');

            $course->addMediaFromRequest('image')
                ->toMediaCollection('images');
        }

        $course->update($request->except('image'));

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {

        $course->clearMediaCollection('images');

        $course->delete();

        return response()->noContent();
    }
}
