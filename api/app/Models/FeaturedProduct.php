<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class FeaturedProduct extends Model
{
    use HasFactory;

    protected $collection = 'featured_products';

    protected $fillable = [
        'product_ids'
    ];
}
