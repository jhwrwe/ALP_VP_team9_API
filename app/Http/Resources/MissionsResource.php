<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
                "remaining"=>$this->remaining,// contoh akses atribut dari relasi mission
                "title" => $this->mission->title,
                "description" => $this->mission->description,
                "quantity" => $this->mission->quantity,
                "coins" => $this->mission->coins,
        ];
    }
}
