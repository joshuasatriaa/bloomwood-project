<?php

namespace App\Http\Controllers;

use App\Filters\CategoryNameFilter;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
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
        if (!request('search')) {
            return Cache::tags(['category-index'])->remember('categories-' . request('page', 1), 600, function () {
                return CategoryResource::collection(Category::orderBy('name')->paginate(request('per_page', 30)));
            });
        }

        $categories = Category::query()->filter([
            CategoryNameFilter::class,
        ])->paginate(request('per_page', 30));

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        Cache::tags(['category-index'])->flush();

        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $category->update($validated);

        Cache::tags(['category-index'])->flush();

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        Cache::tags(['category-index'])->flush();

        return response()->json([], 204);
    }
}
