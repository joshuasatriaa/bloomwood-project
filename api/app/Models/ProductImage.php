<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Mongodb\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $collection = 'product_images';

    protected $fillable = [
        'product_id',
        'original_image',
        'thumbnail_image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function deleteFromStorage(): void
    {
        Storage::disk('public')->delete($this->original_image);
        Storage::disk('public')->delete($this->thumbnail_image);
    }
}
