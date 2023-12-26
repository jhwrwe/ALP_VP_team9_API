<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BadgeUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "id"=> $this->id,
            "user_id"=> $this->user_id,
            "badge_id"=> $this->badge_id,

        ];
        return parent::toArray($request);
    }
}
