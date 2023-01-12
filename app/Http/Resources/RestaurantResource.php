<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'star_rate' => $this->star_rate,
            'minimum_charge' => $this->minimum_charge,
            'delivery_fees' => $this->delivery_fees,
            'image' => $this->image,
            'state' => $this->state,
            'meals' =>  $this->when($this->relationLoaded('meals'), MealResource::collection($this->meals)),
            'comments' => $this->when($this->relationLoaded('comments'), CommentResource::collection($this->comments)),
            //'neighborhood' => $this->relationLoaded('neighborhood') ? new NeighborhoodResource($this->neighborhood) : null,
            'neighborhood' => new NeighborhoodResource($this->neighborhood),
        ];
    }
}
