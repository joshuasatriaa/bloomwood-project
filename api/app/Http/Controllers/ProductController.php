<?php

namespace App\Http\Controllers;

use App\Filters\ProductNameFilter;
use App\Filters\ProductGroupFilter;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\CategoryService;
use App\Services\Contracts\ImageServiceContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $categoryService;
    protected $imageService;

    public function __construct(CategoryService $categoryService, ImageServiceContract $imageService)
    {
        $this->categoryService = $categoryService;
        $this->imageService = $imageService;

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
        // if (!request('search')) {
        //     return Cache::tags(['products-index'])->remember('products-' . request('page', 1), 600, function () {
        //         return ProductResource::collection(Product::latest()->paginate(30));
        //     });
        // }

        $products = Product::query()->filter([
            ProductNameFilter::class,
            ProductGroupFilter::class,
        ])->paginate(request('per_page', 30));

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        $paths = $this->imageService->uploadImages($request, 'product-images', 'images');


        $product = Product::create($validated);
        $product->productImages()->createMany($paths);

        if ($validated['variants'][0]['name']) {
            $validated = $this->saveVariants($request, $validated);
            $product->productVariants()->createMany($validated['variants']);
        }

        if ($validated['add_ons'][0]['name']) {
            $validated = $this->saveAddOns($request, $validated);
            $product->productAddOns()->createMany($validated['add_ons']);
        }

        $product->categories()->sync($validated['category_ids']);

        Cache::tags(['products-index'])->flush();

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);
        $product->categories()->sync($validated['category_ids']);

        $paths = $this->imageService->uploadImages($request, 'product-images', 'images');
        if (count($paths) > 0) {
            $product->productImages()->createMany($paths);
        }

        if ($validated['variants'][0]['name']) {
            $validated = $this->saveVariants($request, $validated);
            $product->productVariants()->createMany($validated['variants']);
        }

        if ($validated['add_ons'][0]['name']) {
            $validated = $this->saveAddOns($request, $validated);
            $product->productAddOns()->createMany($validated['add_ons']);
        }

        Cache::tags(['products-index'])->flush();

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->deleteProductImages($product);

        $product->delete();

        Cache::tags(['products-index'])->flush();

        return response()->json([], 204);
    }

    private function deleteProductImages(Product $product)
    {
        $images = $product->productImages()->get();

        /**
         * @var ProductImage $image
         */
        foreach ($images as $image) {
            $image->deleteFromStorage();
            $image->delete();
        }
    }

    private function saveVariants(Request $request, array $validated)
    {
        $thumbnails = $this->imageService->uploadThumbnails($request, 'product-images', 'variants', 'thumbnail_image');
        foreach ($thumbnails as $index => $thumb) {
            $validated['variants'][$index]['thumbnail_image'] = $thumb;
        }

        return $validated;
    }

    private function saveAddOns(Request $request, array $validated)
    {
        $thumbnails = $this->imageService->uploadThumbnails($request, 'product-images', 'add_ons', 'thumbnail_image');
        foreach ($thumbnails as $index => $thumb) {
            $validated['add_ons'][$index]['thumbnail_image'] = $thumb;
        }

        return $validated;
    }
}
