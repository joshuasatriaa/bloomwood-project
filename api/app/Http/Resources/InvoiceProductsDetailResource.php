<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class InvoiceProductsDetailResource extends JsonResource
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
            'name' => $this->name,
            'size' => $this->size,
            'total_price' => $this->total_price,
            'thumbnail_image' => $storage->url($this->thumbnail_image)

        ];
    }
}
