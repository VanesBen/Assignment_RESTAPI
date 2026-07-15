<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "id" => $this->id,
            "seller_id" => $this->seller_id,
            'category_id' => $this->category_id, 
            'title' => $this->title, 
            'description' => $this->description, 
            'price' => $this->price, 
            'rating' => $this->rating, 
            'file_path' => $this->file_path, 
            'download_count' => $this->download_count,
            'thumbnail' => $this->thumbnail, 
            'status' => $this->status
        ];
    }
}
