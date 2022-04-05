<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @group product management
 *
 * APIs for managing product
 *
 */
class productController extends Controller
{

    /**
     * get product
     *
     * this route is called when to get get specific quained of product
     *
     * @authenticated
     * @urlParam lang The language. Example: en
     *
     */
    public function products()
    {
        $data = Product::paginate();
        return  ProductResource::collection($data);
    }
}
