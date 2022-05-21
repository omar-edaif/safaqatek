<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Coupon extends Model
{
    use HasFactory;



    /**
     * Get the product of current Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,);
    }
    /**
     * Get the user associated with the Coupon
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function isWinner(): HasOne
    {
        return $this->hasOne(Winner::class, 'coupon', 'key');
    }
}
