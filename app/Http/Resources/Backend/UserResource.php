<?php

namespace App\Http\Resources\Backend;

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
            'shop_id' => $this->shop ? $this->shop->id : null,
            'role' => $this->roles[0]->name,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile' => $this->profile,
            'created_at' => $this->created_at
        ];
    }
}