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
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'nationality' => $this->nationality()->pluck('name_' . app()->getLocale() . ' as name')->values()->first() ?? "",
            'residence' => $this->residence()->pluck('name_' . app()->getLocale() . ' as name')->values()->first() ?? "",
            'currency' => getCurrency($this->currency),
            'addresse' => $this->addresse ?: '',
            'phone' => $this->phone,
            'avatar' => $this->avatar,
            'lang' => $this->lang,
            'sex' => $this->sex,
            'allow_notifications' => $this->allow_notifications,
            'purchases' => (int) $this->purchases()->sum('quantity'),
        ];
    }
}
