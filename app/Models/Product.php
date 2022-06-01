<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Boolean;

class Product extends Model
{
    use HasFactory, SoftDeletes;



    protected $dates = ['closing_at'];

    protected $casts = [
        'closing_at'        => 'date:m/d/Y',
        'created_at'        => 'date:m/d/Y',
        'quantity'          => 'integer',
        'copon_per_unit'    => 'integer',
        'price'             => 'double',
        'sold_out'          => 'integer'

    ];
    /**
     * Get the category of Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }


    /**
     * Get all of the orders for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inOrders(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function inWishlist()
    {
        return $this->hasOne(UserWishlist::class)->where('user_id', auth()->guard('sanctum')->id());
    }


    /**
     * Get the winner associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function winner(): HasOne
    {
        return $this->hasOne(Winner::class);
    }

    /**
     * Get if user  add the Product to wish list
     *
     *
     */
    public function isFavorite()
    {
        return $this->hasOne(UserWishlist::class)->whereUserId(auth()->guard('sanctum')->id());
    }

    public function isParticipate()
    {
        return $this->hasMany(Coupon::class)->whereUserId(auth()->guard('sanctum')->id());
    }
}
