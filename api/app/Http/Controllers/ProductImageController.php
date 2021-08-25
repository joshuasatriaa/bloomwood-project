<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Support\Facades\Cache;

class ProductImageController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role.check:superadmin,admin'])->only(['destroy']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImage $productImage)
    {
        $productImage->deleteFromStorage();
        $productImage->delete();

        Cache::tags(['products-index'])->flush();

        return response()->json([], 204);
    }
}
