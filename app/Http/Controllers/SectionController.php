<?php

namespace App\Http\Controllers;

use App\Http\Requests\Section\StoreRequest;
use App\Http\Requests\Section\UpdateRequest;
use App\Http\Resources\SectionResource;
use App\Section;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SectionResource::collection(Section::orderByDesc('updated_at')->paginate(app('pagination_value')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return new SectionResource(Section::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return new SectionResource($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Section $section)
    {

        $section->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {

        $section->delete();

        return response()->noContent();
    }

    /**
     * assgin student (User) to class (Section)
     *
     * @param \App\Section $section
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function assign(Section $section, User $user)
    {

        try {

            $section->assignStudent($user);
        } catch (Exception $ex) {

            return response()->json(['message' => $ex->getMessage()])->setStatusCode(Response::HTTP_EXPECTATION_FAILED);
        }

        return response()->noContent();
    }

    /**
     * fire student (User) from class (Section)
     *
     * @param \App\Section $section
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function fire(Section $section, User $user)
    {

        try {

            $section->fireStudent($user);
        } catch (Exception $ex) {

            return response()->json(['message' => $ex->getMessage()])->setStatusCode(Response::HTTP_EXPECTATION_FAILED);
        }

        return response()->noContent();
    }
}
