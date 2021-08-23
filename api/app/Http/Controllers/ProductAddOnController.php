<?php

namespace App\Http\Controllers;

use App\Models\ProductAddOn;
use Illuminate\Support\Facades\Cache;

class ProductAddOnController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role.check:superadmin,admin'])->only(['destroy']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAddOn  $productAddOn
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAddOn $productAddOn)
    {
        $productAddOn->deleteFromStorage();
        $productAddOn->delete();

        Cache::tags(['products-index'])->flush();

        return response()->json([], 204);
    }
}
