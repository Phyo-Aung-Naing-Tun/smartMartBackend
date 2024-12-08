<?php

namespace App\Http\Resources\Backend;

use App\Http\Resources\Backend\Shop\BasicShopResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class UserResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //user will have only one role
        return [
            'id' => hash_id($this->id),
            'role' => $this->roles[0]?->name,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile' => $this->profile,
            'status' => $this->status,
            'shop' => $this->shop ? BasicShopResource::make($this->shop) : null,
            'created_at' => $this->created_at
        ];
    }
}