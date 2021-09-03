<?php

namespace App\Filters;
use App\Models\NavigationGroup;

class ProductGroupFilter
{

    public function handle($query, $next)
    {
        if (request()->has('group')) {
            $group = NavigationGroup::where('slug', request('group'))->first();

            $categoryIds = $group->categories()->get()->pluck('id')->toArray();

            $query->whereHas('categories', function ($q) use ($categoryIds) {
               $q->whereIn('_id', $categoryIds);
            });
        }

        $next($query);
    }
}
