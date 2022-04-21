<?php

namespace App\Http\Resources\api;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $currency = auth()->user()->currency ?? 'aed';
        return [
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'created_at' => $this->created_at->format('m/d/Y'),
            'cart' => $this->products->map(fn ($product) => [
                'name'   => $product["name_" . app()->getLocale()],
                'price'     => $product->price,
                'currency'  => $currency,
                'quantity'  => $product->pivot->quantity

            ]),
            'coupons' => $this->coupons->map(fn ($coupon) => new CouponResource($coupon))
        ];
    }
}
