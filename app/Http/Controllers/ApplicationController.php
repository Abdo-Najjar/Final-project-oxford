<?php

namespace App\Http\Controllers;

use App\Application;
use App\Http\Requests\Application\StoreRequest;
use App\Http\Resources\ApplicationResource;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApplicationResource::collection(Application::orderByDesc('updated_at')->paginate(app('pagination_value')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return new ApplicationResource(Application::create($request->validated()));
    }

    /**
     * Display the specified resource.
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        return new ApplicationResource($application);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return response()->noContent();
    }
}
