<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodolistResource extends JsonResource
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
            "title" => $this->title,
            "date" => $this->date,
            "time" => $this->time,
            "progress_status" => $this->progress_status,
            "location" => $this->location,
        ];
    }
}
