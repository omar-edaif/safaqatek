<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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

            "key" => $this->key,
            "participate_with" => $this->participate_with,
            "created_at" => $this->created_at->format('m/d/Y h:m:s'),
            'product' => [
                "name_ar" => $this->product->name_ar,
                "name_en" => $this->product->name_en,
                "image" => asset($this->product->image),
                'closing_at' => $this->product->closing_at->format('m/d/Y h:m:s'),
                'price' => $this->product->price,
                'currency' => auth()->user()->currency ?? 'aed',
            ]
        ];
    }
}
