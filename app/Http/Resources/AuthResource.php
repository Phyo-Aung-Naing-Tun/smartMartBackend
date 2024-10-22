<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => Hash::make($this->id),
            "profile" => $this->profile,
            "name" => $this->name,
            "phone" => $this->phone,
            "email" => $this->email,
            "address" => $this->address,
            "created_at" => $this->created_at,
        ];
    }
}
