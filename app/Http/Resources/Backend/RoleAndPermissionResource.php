<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleAndPermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return([
            'id' => hash_id($this->id),
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
            
        ]);
    }
}