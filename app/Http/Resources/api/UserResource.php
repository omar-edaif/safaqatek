<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'nationality' => $this->nationality,
            'residence' => $this->residence,
            'currency' => $this->currency,
            'level' => 1,
            'phone' => $this->phone,
            'avatar' => $this->avatar,
            'lang' => $this->lang,
            'sex' => $this->sex,
        ];
    }
}
