<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ProductResource;
use App\Http\Resources\api\WinnerResource;
use App\Models\Product;
use App\Models\UserWishlist;
use App\Models\Winner;
use Illuminate\Http\Request;

/**
 * @group product management
 *
 * APIs for managing product
 *
 */
class productController extends Controller
{

    public function __construct()
    {
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->middleware('auth:sanctum');
        }
    }
    /**
     * get product
     *
     * this route is called when to get get specific quained of product
     *
     *
     * @urlParam lang string required  The language. Example: en
     *
     * @queryParam  is_close boolean The show only available products  .
     * @queryParam  category integer filter by category .
     * @queryParam  sold_out_filter boolean filter by sold out .
     *
     */

    public function products(Request $request)
    {

        $data = Product::where('closing_at', filter_var($request->input('is_close'), FILTER_VALIDATE_BOOL) ? '<' : '>=', now())
            ->when(request('category'), fn ($query) => $query->where('product_category_id', request('category')))
            ->with('isFavorite')
            ->withSum('inOrders as sold_out', 'quantity')
            ->withExists('isParticipate as isParticipate')
            ->orderBy('closing_at')
            ->paginate(20);

        return  ProductResource::collection($data);
    }
    /**
     * get current product
     *
     * this route is called when to get get specific quained of product
     *
     *
     * @urlParam lang string required  The language. Example: en
     * @urlParam id integer required  The language. Example: 1
     *
     *
     *
     *
     */

    public function product(Request $request)
    {

        $data = Product::whereId($request->route('id'))
            ->with('isFavorite')
            ->withSum('inOrders as sold_out', 'quantity')
            ->withExists('isParticipate as isParticipate')
            ->get();

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
     * delete product from wishlist
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



    /**
     * product winners
     *
     * @response 200 scenario="winners" {"data":[{"username":"jaafar","url":"https://www.youtube.com/watch?v=iWwY6K5Vjyo","award_name_en":"Mr.","award_name_ar":"أسم الجائزة بالعربي","announced_on":"April 14, 2022","is_current_user":false},{"username":"jaafar","url":"https://www.youtube.com/watch?v=iWwY6K5Vjyo","award_name_en":"Ms.","award_name_ar":"أسم الجائزة بالعربي","announced_on":"April 14, 2022","is_current_user":false},{"username":"jaafar","url":"https://www.youtube.com/watch?v=iWwY6K5Vjyo","award_name_en":"Mr.","award_name_ar":"أسم الجائزة بالعربي","announced_on":"April 14, 2022","is_current_user":false}],"links":{"first":"http://safaqatek.test/api/v1/aut/product/winners?page=1","last":"http://safaqatek.test/api/v1/aut/product/winners?page=1","prev":null,"next":null},"meta":{"current_page":1,"from":1,"last_page":1,"links":[{"url":null,"label":"&laquo; Previous","active":false},{"url":"http://safaqatek.test/api/v1/aut/product/winners?page=1","label":"1","active":true},{"url":null,"label":"Next &raquo;","active":false}],"path":"http://safaqatek.test/api/v1/aut/product/winners","per_page":20,"to":3,"total":3}}
     *
     *
     */

    public function winners()
    {
        $winners  =   Winner::with('user:id,firstname,lastname', 'award:id,award_name_ar,award_name_en')->paginate(20);
        return WinnerResource::collection($winners);
    }
}
