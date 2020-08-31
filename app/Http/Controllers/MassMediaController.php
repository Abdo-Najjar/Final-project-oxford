<?php

namespace App\Http\Controllers;

use App\CourseType;
use App\Http\Resources\MediaResource;
use App\MassMedia;
use Illuminate\Http\Request;

class MassMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MediaResource::collection(MassMedia::orderByDesc('updated_at')->paginate(app('pagination_value')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function courseTypeIndex(CourseType $courseType)
    {
        return MediaResource::collection($courseType->media()->orderByDesc('updated_at')->paginate(app('pagination_value')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MassMedia  $massMedia
     * @return \Illuminate\Http\Response
     */
    public function show(MassMedia $massMedia)
    {

        return new MediaResource($massMedia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MassMedia  $massMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(MassMedia $massMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MassMedia  $massMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MassMedia $massMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MassMedia  $massMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(MassMedia $massMedia)
    {
        //
    }
}
