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
            "name_en" => $this->name_en,
            "name_ar" => $this->name_ar,
            "award_name_ar" => $this->award_name_ar,
            "award_name_en" => $this->award_name_en,
            "image" => url('public/' . $this->image),
            "award_image" => url('public/' . $this->award_image),
            "description_ar" => $this->description_ar,
            "description_en" => $this->description_en,
            "quantity" => $this->quantity,
            "sold_number" =>  +rand(0, $this->quantity - 1),
            'copon_per_unit' => $this->copon_per_unit,
            "closing_at" => $this->closing_at,
            "created_at" => $this->created_at,

        ];
    }
}
