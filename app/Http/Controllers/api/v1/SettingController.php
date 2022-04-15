<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContuctUsRequest;
use App\Models\ProductCategories;
use App\Models\Queries;
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
     * this route is called to get all settings
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
    /**
     * save Queries
     *
     * this route is called to save users Queries
     *
     * @authenticated
     * @urlParam lang The language. Example: en
     *
     */
    public function contuctUs(ContuctUsRequest $request)
    {
        Queries::create([
            'name' => $request->name,
            'email' => $request->email,
            'Inquiry_message' => $request->Inquiry_message,
        ]);

        return response()->message(__('Your inquiry has been registered successfully. We will reply to you as soon as we see it'));
    }
}
