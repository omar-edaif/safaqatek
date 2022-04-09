<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;



    protected $dates = ['closing_at'];

    protected $casts = [
        'closing_at' => 'date:m/d/Y',
        'created_at' => 'date:m/d/Y',
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
}
