<?php

namespace App\Http\Controllers;

use App\Http\Requests\NavigationGroupRequest;
use App\Http\Resources\NavigationGroupResource;
use App\Models\NavigationGroup;
use Illuminate\Http\Request;

class NavigationGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role.check:superadmin,admin'])->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NavigationGroupResource::collection(NavigationGroup::with('categories.allSubCategories')->latest());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\NavigationGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavigationGroupRequest $request)
    {
        $validated = $request->validated();

        $navigationGroup = NavigationGroup::create($validated);
        $navigationGroup->categories()->sync($validated['category_ids']);

        return (new NavigationGroupResource($navigationGroup))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NavigationGroup  $navigationGroup
     * @return \Illuminate\Http\Response
     */
    public function show(NavigationGroup $navigationGroup)
    {
        return new NavigationGroupResource($navigationGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\NavigationGroupRequest  $request
     * @param  \App\Models\NavigationGroup  $navigationGroup
     * @return \Illuminate\Http\Response
     */
    public function update(NavigationGroupRequest $request, NavigationGroup $navigationGroup)
    {
        $validated = $request->validated();

        $navigationGroup->update($validated);
        $navigationGroup->categories()->sync($validated['category_ids']);

        return new NavigationGroupResource($navigationGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NavigationGroup  $navigationGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(NavigationGroup $navigationGroup)
    {
        $navigationGroup->categories()->sync([]);

        $navigationGroup->delete();

        return response()->json([], 204);
    }
}
