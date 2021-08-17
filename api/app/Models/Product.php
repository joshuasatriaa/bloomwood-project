<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $collection = 'products';

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description'
    ];

    protected $with = [
        'user',
        'categories',
        'productImages'
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
}
