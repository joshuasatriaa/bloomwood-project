<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role.check:superadmin,admin'])->only(['store', 'update', 'destroy']);
        // $this->middleware('check.pin')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cache::tags('products-index')
            ->remember('products-' . request()->get('page', 1), 33600, function () {
                return ProductResource::collection(Product::latest()->paginate(30));
            });
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
     * @param string $_
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(string $_, Product $product)
    {
        return Cache::tags('products-show')
            ->remember('products-' . $product->id, 33600, function () use ($product) {
                return new ProductResource($product);
            });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
