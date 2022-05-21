<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContuctUsRequest;
use App\Http\Resources\api\countryResource;
use App\Http\Resources\api\settingsresource;
use App\Models\Country;
use App\Models\Currency;
use App\Models\ProductCategories;
use App\Models\Queries;
use App\Models\UserLevels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;

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
     *
     * @urlParam lang The language. Example: en
     *
     */
    public function index()
    {
        $allSettings  =   DB::table('settings')->get();
        $categoryAllPrize = ['id' => 0, 'name' => __('all prizes'), 'image' => ''];

        return response()->json(['data' => [
            'levels' => UserLevels::all(["name_" . app()->getLocale() . ' as name', 'purchase_number']),

            'countries' => countryResource::collection(Country::whereActive(true)->get()),

            'setting' =>   $allSettings
                ->except('support_phone', 'donate_option')
                ->mapWithKeys(function ($item, $key) {
                    return [$item->key =>   $item->{'value_' . app()->getLocale()}];
                })
                ->put('support_phone', $allSettings->where("key", "support_phone")->first()->value_en)
                // Product donation is allowed
                ->put('donate_option', boolval($allSettings->where("key", "donate_option")->first()->value_en))
                // Show prize details
                ->put('showPrizeDetails', boolval($allSettings->where("key", "showPrizeDetails")->first()->value_en)),


            'prouduct_categories' => ProductCategories::all(['id', "name_" . app()->getLocale() . ' as name', 'image'])->prepend($categoryAllPrize),

            'currencies' => Currency::whereActive(true)->pluck('code'),

            'stripe_key' => env('STRIPE_KEY')
        ]]);
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
