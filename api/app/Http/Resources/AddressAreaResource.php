<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressAreaResource extends JsonResource
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
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'urban' => $this->urban,
            'postal_code' => $this->postal_code,
            'small_price' => $this->small_price,
            'medium_price' => $this->medium_price,
        ];
    }
}
