<?php

namespace Database\Seeders\Fake;

use App\Http\Resources\ProductResource;
use App\Models\FeaturedProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class FakeFeaturedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all()->random(6)->pluck('id')->toArray();

        FeaturedProduct::create([
            'product_ids' => $products
        ]);
    }
}
