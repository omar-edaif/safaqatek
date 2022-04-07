<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use Illuminate\Http\Request;

/**
 * @group setting management
 *
 * APIs for managing settings
 *
 */
class SettingController extends Controller
{
    /**
     * get settings
     *
     * this route is called when to get all settings
     *
     * @authenticated
     * @urlParam lang The language. Example: en
     *
     */
    public function index()
    {
        $setting = [
            'product_catgories' => ProductCategories::all(),

            'stripe_key' => env('STRIPE_KEY'),
            // is possible to donate products
            'donate_option' => true
        ];

        return response()->data($setting);
    }
}
