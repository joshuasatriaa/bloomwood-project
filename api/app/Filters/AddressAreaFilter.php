<?php

namespace App\Filters;

class AddressAreaFilter
{

    public function handle($query, $next)
    {
        if (request()->has('search') && request()->get('search')) {
            $query->where(function ($q) {
                $q->where('province', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('city', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('district', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('urban', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('postal_code', 'LIKE', '%' . request('search') . '%');
            });
        }

        $next($query);
    }
}
