<?php

namespace App\Http\Controllers;

use App\Filters\AddressAreaFilter;
use App\Http\Requests\AddressAreaRequest;
use App\Http\Resources\AddressAreaResource;
use App\Models\AddressArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AddressAreaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role.check:superadmin,admin'])->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!request('search')) {
        //     return Cache::tags(['address-areas-index'])->rememberForever('address-area-' . request('page', 1), function () {
        //         return AddressAreaResource::collection(AddressArea::paginate(100));
        //     });
        // }

        $areas = AddressArea::query()->filter([
            AddressAreaFilter::class,
        ])->paginate(request('per_page', 100));


        return AddressAreaResource::collection($areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddressAreaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressAreaRequest $request)
    {
        $area = AddressArea::create($request->validated());

        return (new AddressAreaResource($area))
            ->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddressArea  $addressArea
     * @return \Illuminate\Http\Response
     */
    public function show(AddressArea $addressArea)
    {
        return new AddressAreaResource($addressArea);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AddressAreaRequest  $request
     * @param  \App\Models\AddressArea  $addressArea
     * @return \Illuminate\Http\Response
     */
    public function update(AddressAreaRequest $request, AddressArea $addressArea)
    {
        $validated = $request->validated();

        $addressArea->update($validated);
        Cache::tags(['address-areas-index'])->flush();

        return new AddressAreaResource($addressArea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddressArea  $addressArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddressArea $addressArea)
    {
        $addressArea->delete();

        return response()->json('', 204);
    }
}
