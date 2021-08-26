<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Jenssegers\Mongodb\Eloquent\Model;

class NavigationGroup extends Model
{
    use HasFactory;

    protected $collection = 'navigation_groups';

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $with = [
        'categories'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function ($navigationGroup) {
            $navigationGroup->slug = Str::slug($navigationGroup->name);
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, null, 'navigation_group_ids', 'category_ids');
    }
}
