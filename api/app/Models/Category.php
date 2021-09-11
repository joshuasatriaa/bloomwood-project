<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use FilterTrait;

    protected $collection = "categories";

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'thumbnail_image'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, null, 'category_ids', 'product_ids');
    }

    public function navigationGroups()
    {
        return $this->belongsToMany(NavigationGroup::class, null, 'category_ids', 'navigation_group_ids');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allSubCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('subCategories');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
