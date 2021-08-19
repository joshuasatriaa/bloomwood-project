<?php

namespace App\Filters;

class ProductNameFilter
{

    public function handle($query, $next)
    {
        if (request()->has('search') && request('search')) {
            $query->where(function ($q) {
                $q->where('name', 'LIKE', '%' . request('search') . '%');
            });
        }

        $next($query);
    }
}
