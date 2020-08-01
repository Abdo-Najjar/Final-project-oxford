<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Course;
use App\Http\Requests\Advertisement\StoreRequest;
use App\Http\Resources\AdvertisementResource;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdvertisementResource::collection(Advertisement::orderByDesc('updated_at')->paginate(app('pagination_value')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        $advertisement = Advertisement::create($request->only('course_id'));

        $advertisement->addMediaFromRequest('image')
            ->toMediaCollection('images');

        return  response(new AdvertisementResource($advertisement->fresh()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {

        $advertisement->clearMediaCollection('images');

        $advertisement->delete();

        return response()->noContent();
    }
}
