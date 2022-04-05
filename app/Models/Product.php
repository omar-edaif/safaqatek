<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;



    protected $dates = ['closing_at'];

    protected $casts = [
        'closing_at' => 'datetime:Y-m-d H:00',
        'created_at' => 'datetime:Y-m-d H:00',
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
}
