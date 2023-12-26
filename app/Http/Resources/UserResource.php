<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
                "fullname"=> $this->fullname,
                "phone_number"=>$this->phone_number,
                "email"=>$this->email,
                "username"=>$this->username,
                "password"=>$this->password,
                "coins"=>$this->coins,
                "profile_picture"=>$this->profile_picture,
        ];
    }
}