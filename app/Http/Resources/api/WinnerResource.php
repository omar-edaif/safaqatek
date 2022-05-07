<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Resources\Json\JsonResource;

class WinnerResource extends JsonResource
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
            'username' => $this->user->username,
            'url'  => $this->url,
            'award_name' => $this->award['award_name_' . app()->getLocale()],
            'announced_on' => $this->created_at->format('h:i A, d F Y'),
            'coupon' => $this->coupon,
            'is_current_user' => auth()->id() == $this->user->id

        ];
    }
}
