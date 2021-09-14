<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeaturedProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\FeaturedProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FeaturedProductController extends Controller
{
    protected $cacheKey;

    public function __construct()
    {
        $this->middleware(['role.check:superadmin,admin'])->only(['store', 'update', 'destroy']);
        $this->cacheKey = 'featured-products';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cache::rememberForever($this->cacheKey,  function () {
            return ProductResource::collection($this->getProductsInFeatured());
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FeaturedProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeaturedProductRequest $request)
    {
        $validated = $request->validated();
        $fp = FeaturedProduct::first();

        $fp ? $fp->update($validated) : FeaturedProduct::create($validated);

        $this->refreshCache();
        return Cache::get($this->cacheKey);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeaturedProduct  $featuredProduct
     * @return \Illuminate\Http\Response
     */
    public function show(FeaturedProduct $featuredProduct)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FeaturedProductRequest  $request
     * @param  \App\Models\FeaturedProduct  $featuredProduct
     * @return \Illuminate\Http\Response
     */
    public function update(FeaturedProductRequest $request, FeaturedProduct $featuredProduct)
    {
        $validated = $request->validated();

        $featuredProduct->update($validated);

        $this->refreshCache();
        return Cache::get($this->cacheKey);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeaturedProduct  $featuredProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeaturedProduct $featuredProduct)
    {
        //
    }

    protected function getProductsInFeatured(): Collection
    {
        $fp = FeaturedProduct::first();
        $products = Product::whereIn('_id', $fp->product_ids)->get();

        return $products;
    }

    protected function refreshCache()
    {
        Cache::forever($this->cacheKey, ProductResource::collection($this->getProductsInFeatured()));
    }
}
