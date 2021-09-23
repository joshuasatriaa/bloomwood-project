<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonyRequest;
use App\Http\Resources\TestimonyResource;
use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
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
        return TestimonyResource::collection(Testimony::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TestimonyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonyRequest $request)
    {
        $t = Testimony::create($request->validated());

        return (new TestimonyResource($t))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function show(Testimony $testimony)
    {
        return new TestimonyResource($testimony);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TestimonyRequest   $request
     * @param  \App\Models\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonyRequest $request, Testimony $testimony)
    {
        $testimony->update($request->validated());

        return new TestimonyResource($testimony);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimony $testimony)
    {
        $testimony->delete();

        return response()->json('', 204);
    }
}
