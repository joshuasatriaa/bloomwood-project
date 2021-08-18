<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $storage = Storage::disk('public');

        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'original_image' => $storage->url($this->original_image),
            'thumbnail_image' => $storage->url($this->thumbnail_image),
        ];
    }
}
