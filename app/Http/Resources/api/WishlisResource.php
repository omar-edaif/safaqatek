<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlisResource extends JsonResource
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
            "name" => $this["name_" . app()->getLocale()],
            'award_name' => $this["award_name_" . app()->getLocale()],
            'price'   => $this->price,
            'currency' => auth()->user()->currency ?? 'aed',
            "image" => asset($this->image),
            "quantity" => $this->quantity,
            'sold_out' => $this->inOrders ? $this->inOrders->sum('quantity') : 0,
        ];
    }
}
