<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        Storage::disk('public')->delete($productImage->original_image);
        Storage::disk('public')->delete($productImage->thumbnail_image);
        $productImage->delete();

        return response()->json([], 204);
    }
}
