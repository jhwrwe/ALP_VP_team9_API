<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodolistDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "date" => $this->date,
            "time" => $this->time,
            "urgency_status" => $this->urgency_status,
            "description" => $this->description,
            "progress_status" => $this->progress_status,
            "location" => $this->location,
            "user_id" => $this->user_id
        ];
    }
}
