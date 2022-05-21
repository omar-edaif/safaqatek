<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Resources\Json\JsonResource;

class countryResource extends JsonResource
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
            "name" => $this->{'name_' . app()->getLocale()},
            'code' => $this->code,
            'dialCode' => $this->dialCode,
            'maxLength' => $this->maxLength,
            'minLength' => $this->minLength,
            'flag'  => asset($this->flag),
        ];
    }
}
