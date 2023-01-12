<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'restaurant' => new RestaurantResource($this->restaurant),// n+1
            'date_time' => $this->created_at,
            'address' => $this->delivery_address,
            'meals_cost' => $this->meals_cost,
            'delivery_fees' => $this->delivery_fees,
            'total_order_price' => $this->total_order_price,
            'payment_method' => $this->payment_method,
            'state' => $this->state
        ];
    }
}
