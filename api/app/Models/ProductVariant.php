<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $collection = 'product_variants';

    protected $fillable = [
        'name',
        'thumbnail_image'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleted(function ($variant) {
            $variant->deleteFromStorage();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function deleteFromStorage(): void
    {
        Storage::disk('public')->delete($this->thumbnail_image);
    }
}
