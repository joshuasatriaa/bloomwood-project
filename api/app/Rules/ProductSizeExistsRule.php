<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class ProductSizeExistsRule implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $productIds = array_map(function ($p) {
            return $p['id'];
        }, $value);

        $products = Product::whereIn('_id', $productIds)->get();

        foreach ($value as $product) {
            $p = $products->where('_id', $product['id'])->first();
            if (!$p) {
                return false;
            }

            $chosenSize = $product['size'];
            $productSizes = collect($p->sizes);

            $sizeExists = $productSizes->where('name', $chosenSize)->first();

            if (!$sizeExists) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The product not found or the product doesn\'t have the size.';
    }
}
