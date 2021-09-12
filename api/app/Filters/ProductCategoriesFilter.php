<?php

namespace App\Filters;

use App\Models\Category;
use App\Models\NavigationGroup;

class ProductCategoriesFilter
{

    public function handle($query, $next)
    {
        if (request()->has('category')) {
            $category = Category::where('slug', request('category'))->first();
            $children = $category->allSubCategories()->get()->pluck('id')->toArray();

            $categoryId = [$category->id];
            $categoryIds = array_merge($categoryId, $children);

            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('_id', $categoryIds);
            });
        }

        $next($query);
    }
}
