<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'uuid' => $this->id,
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'role' => new RoleResource($this->role),
            'has_pin' => $this->userPin()->exists(),
            'is_suspended' => (bool) $this->is_suspended,
            'addresses' => CustomerAddressResource::collection($this->customerAddresses)
        ];
    }
}
