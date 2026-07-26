<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            "total_amount" => $this->total_amount,
            'status' => $this->status,
            'seller_id' => $this->seller_id,
            'buyer_id' => $this->buyer_id,

            'items' => TransactionDetailResource::collection($this->details),
        ];
    }
}
