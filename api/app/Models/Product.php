<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FilterTrait;

    protected $dates = ['deleted_at'];

    protected $collection = 'products';

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
    ];

    protected $with = [
        'user',
        'user.role',
        'categories',
        'productImages',
        'productVariants'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, null, 'product_ids', 'category_ids');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
