<?php

namespace App\Http\Resources\Backend\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasicShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => hash_id($this->id),
            'name' => $this->name,
            'profile' => $this->profile,
            'email' => $this->email,
            'phone' => $this->phone,
            'about' => $this->about,
            'address' => $this->address,
            'slogan' => $this->slogan,
            'this' => $this->type,
            'status' => $this->status,
            'schedule' => $this->schedule,
            'suspended_at' => $this->suspended_at,
            'created_at' => $this->created_at,

        ];
    }
}