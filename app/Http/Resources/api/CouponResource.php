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
                "id" => $this->product->id,
                "name" => $this->product["name_" . app()->getLocale()],
                "award_name" => $this->product["award_name_" . app()->getLocale()],
                "image" => url('public' . $this->product->image),
                "award_image" => url('public' . $this->product->award_image),
                "closing_at" => $this->product->closing_at->format('m/d/Y'),
                "created_at" => $this->product->created_at->format('m/d/Y'),
                'price' => $this->product->price,
                'currency' => auth()->user()->currency ?? 'aed',
            ]

        ];
    }
}
