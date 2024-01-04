<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

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
            'status' => Response::HTTP_OK,
            'message' => "Success",
            'data' => [
                "id" => $this->id,
                "title" => $this->title,
                "date" => $this->date,
                "time" => $this->time,
                "location" => $this->location,
            ]
        ];
    }
}
