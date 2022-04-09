<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ProductResource;
use App\Models\Product;
use App\Models\UserWishlist;
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
     * @urlParam lang string required  The language. Example: en
     *
     *
     */
    public function products()
    {
        $data = Product::withSum('inOrders', 'quantity')->orderBy('closing_at')->paginate();
        return  ProductResource::collection($data);
    }
    /**
     * add product to wishlist
     *
     * this route is called when the user wants to add a product to the Wish List
     *
     * @authenticated
     * @urlParam lang  string required The language. Example: en
     * @urlParam id integer required The ID of the product . Example: 1
     */
    public function addToWishlist(Request $request)
    {
        UserWishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $request->id,
        ]);

        return response()->message(__("The product has been added to the wishlist"));
    }

    /**
     * add product to wishlist
     *
     * this route is called when the user wants to delete a product to the Wish List
     *
     * @authenticated
     * @urlParam lang  string required The language. Example: en
     * @urlParam id integer required The ID of the product . Example: 1
     */

    public function deleteFromWishlist(Request $request)
    {
        UserWishlist::where([
            'user_id' => auth()->id(),
            'product_id' => $request->id,
        ])->delete();

        return response()->message(__("The product has been deleted from the wishlist"));
    }
}
