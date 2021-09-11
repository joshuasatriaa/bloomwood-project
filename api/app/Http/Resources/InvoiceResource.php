<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class InvoiceResource extends JsonResource
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
            'user_id' => $this->user_id,
            'invoice_number' => $this->invoice_number,
            'notes' => $this->notes,
            'address' => $this->address,
            'address_area' => $this->address_area,
            'pick_up' => $this->pick_up,
            'products_detail' => $this->products_detail,
            'delivery_fee' => $this->delivery_fee,
            'status' => $this->status,
            'grand_total' => $this->grand_total,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'created_at_format' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'payment_token' => $this->token,
            'user' => new UserResource($this->user),
        ];
    }
}
