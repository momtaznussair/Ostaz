<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gen,
            'age' => $this->age,
            'city' => $this->city()->pluck('name', 'id'),
            'country' => $this->city->country()->pluck('name', 'id'),
            'phone' => $this->phone
        ];
    }
}
