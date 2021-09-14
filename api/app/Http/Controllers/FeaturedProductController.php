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
    protected $tagKey;

    public function __construct()
    {
        $this->middleware(['role.check:superadmin,admin'])->only(['store', 'update', 'destroy']);
        $this->cacheKey = 'featured-products';
        $this->tagKey = 'featured-products-tag';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cache::tags($this->tagKey)->rememberForever($this->cacheKey,  function () {
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
        return ProductResource::collection($this->getProductsInFeatured());
    }


    protected function getProductsInFeatured(): Collection
    {
        $fp = FeaturedProduct::first();
        $productIds = $fp->product_ids;

        $sorter = static function ($product) use ($productIds) {
            return array_search($product->id, $productIds);
        };

        $products = Product::whereIn('_id', $productIds)->get()->sortBy($sorter);


        return $products;
    }

    protected function refreshCache()
    {
        Cache::tags($this->tagKey)->flush();
        Cache::tags($this->tagKey)->forever($this->cacheKey, ProductResource::collection($this->getProductsInFeatured()));
    }
}
