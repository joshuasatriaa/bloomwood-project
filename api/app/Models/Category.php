<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $collection = "categories";

    protected $fillable = [
        'name',
        'slug'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
