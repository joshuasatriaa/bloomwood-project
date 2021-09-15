<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'label' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
            'children' => CategoryResource::collection(
                $this->whenLoaded('allSubCategories')
            ),
            'thumbnail_image' => $this->thumbnail_image ? Storage::disk('public')->url($this->thumbnail_image) : null,
        ];
    }
}
