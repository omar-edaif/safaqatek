<?php

namespace App\Http\Resources\api;

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
            "name" => $this["name_" . app()->getLocale()],
            "award_name" => $this["award_name_" . app()->getLocale()],
            "image" => url('public' . $this->image),
            "award_image" => url('public' . $this->award_image),
            "description" => $this["description_" . app()->getLocale()],
            "quantity" => $this->quantity,
            "sold_out" =>  intval($this->sold_out) ?: 0,
            'copon_per_unit' => $this->copon_per_unit,
            'price' => $this->price,
            'currency' => auth()->user()->currency ?? 'aed',
            'isFavorite' => boolval($this->isFavorite),
            "closing_at" => $this->closing_at->format('m/d/Y'),
            "created_at" => $this->created_at->format('m/d/Y'),

        ];
    }
}
