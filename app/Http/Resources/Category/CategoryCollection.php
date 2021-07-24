<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;


class CategoryCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'status' => $this->status,
        ];
    }
}
