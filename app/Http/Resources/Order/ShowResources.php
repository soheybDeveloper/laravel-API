<?php
// app/Http/Resources/Order/ShowResource.php

namespace App\Http\Resources\Order;

use App\Http\Resources\Json\JsonResource;


class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            // Add other attributes as needed
        ];
    }
}
