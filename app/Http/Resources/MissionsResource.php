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
                "id"=> $this->id,
                "title"=> $this->title,
                "description"=>$this->description,
                "quantity"=>$this->quantity,
                "coins"=>$this->coins,
                'todolists_count' => $this->todolists_count
        ];
    }
}
