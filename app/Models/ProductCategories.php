<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    use HasFactory;

    public $timestamps = false;




    public function getImageAttribute()
    {
        return asset($this->attributes['image']);
    }
}
