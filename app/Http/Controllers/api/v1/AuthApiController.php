<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\HttpCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\UserUpdateRequest;
use App\Http\Requests\user\LoginUserRequest;
use App\Http\Requests\user\PurchaseRequest;
use App\Http\Requests\user\RegisterUserRequest;
use App\Http\Resources\api\CouponResource;
use App\Http\Resources\api\NotificationResource;
use App\Http\Resources\api\OrderResource;
use App\Http\Resources\api\ProductResource;
use App\Http\Resources\api\UserResource;
use App\Http\Resources\api\WishlisResource;
use App\Models\Coupon;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

/**
 * @group User management
 *
 * APIs for managing users
 *
 */
class AuthApiController extends Controller
{
    /**
     * google apple sign up
     *
     * this route is called when user wont sign with their google or apple
     *
     * @urlParam provider string required must be  google apple .Example: google
     * @urlParam lang The language. Example: en
     *
     */

    public function redirectToProvider($lang, $provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {

            return response()->json(['error' => 'error has detected please make short eveting is okay']);
        }

        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {

            $token = $existingUser->createToken('app_token');
            return response()->json(['id' => $token->accessToken->id, 'token' => $token->plainTextToken]);
        } else {

            $newUser                  = new User;
            $newUser->username        = $user->name;
            $newUser->email           = $user->email;
            $newUser->avatar          = $user->avatar;
            $newUser->save();
        }
        $token = $newUser->createToken('app_token');
        return response()->json(['id' => $token->accessToken->id, 'token' => $token->plainTextToken]);
    }



    /**
     * register
     *
     *  If  data was valid and everything is okay, you'll get a 200 OK response.
     *
     * Otherwise, the request will fail with status 422 with validation error if exist  .
     *
     *
     * @response 422 scenario="validation error" {"message": "The given data was invalid.", "errors": {"username": ["The username field is required."],"email": ["The email field is required."]}}
     * @response 200 scenario="new user" {"id": 20,"token": "20|zojdQE05gbfH8S08Pg6gvOqn7cZjzeJisRSR5Sxu"}
     *
     * @urlParam lang The language. Example: en
     *
     *
     *
     *
     */



    public function register(RegisterUserRequest $request)
    {


        $user = User::create([
            'firstname'  => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => bcrypt($request->password)
        ]);

        $token = $user->createToken('app_token');
        return response()->json(['id' => $token->accessToken->id, 'token' => $token->plainTextToken]);
    }



    /**
     * login
     *
     *  If  data was valid and everything is okay, you'll get a 200 OK response.
     *
     * Otherwise, the request will fail with status 422 with validation error if exist  .
     *
     * @response 422 scenario="validation error" {"message": "The given data was invalid.", "errors": {"message": "The given data was invalid.","errors": {"data": ["The provided credentials are incorrect."]}}}
     * @response 200 scenario="login" {"id": 20,"token": "20|zojdQE05gbfH8S08Pg6gvOqn7cZjzeJisRSR5Sxu"}
     *
     *@urlParam lang The language. Example: en
     */




    public function login(LoginUserRequest $request)
    {

        $user = User::whereEmail(request('email'))->orWhere('phone', request('email'))->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            throw ValidationException::withMessages([
                'data' => [__('The provided credentials are incorrect.')],

            ]);
        }

        $token = $user->createToken('app_token');
        return response()->json(['id' => $token->accessToken->id, 'token' => $token->plainTextToken]);
    }

    /**
     * logout
     *
     *  If  request have param ' token_id ' valid and everything is okay, you'll get a 200 OK response.
     *
     *
     * @response 200 scenario="logout" {"message": "you are logout now"}
     * @authenticated
     * @urlParam lang The language. Example: en
     * @bodyParam token_id The id of user token . Example: 20
     *
     */

    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($request->has('token_id')) $user->tokens()->where('id', $request->tokenId)->delete();
        else $user->tokens()->delete();

        return response()->json(['message' => 'you are logout now']);
    }



    /**
     * Get phone
     *
     *  If  request have param ' email ' exist and everything is okay, you'll get a 200 OK response.
     *
     *
     * @response 200 scenario="logout" { "state": false,"code": "403","error": "لا يوجد مستخدم بهذا البريد الإلكتروني","execution": "0.211 seconds" }
     * @response 200 scenario="logout" {"message": "you are logout now"}
     * @urlParam lang The language. Example: en
     * @bodyParam email string required The email of user  . Example: Exemple@exemple.com
     *
     */



    public function phone(Request $request)
    {
        $phone = User::select('phone')->where('email', $request->email)->first();
        if ($phone) return response()->data($phone);
        return response()->error(HttpCodes::NOT_FOUND, __('There is no user with this email'));
    }

    /**
     * set new password
     *
     *  If  request have param ' email ' exist and everything is okay, you'll get a 200 OK response.
     *
     *
     * @response 200 scenario="new password" {"state":true,"code":"200","message":"password was changed successfully","execution":"0.349 seconds","data":{"id":36,"token":"36|yAhv3yRnNyhJ9lwaPDA4uqVnc0nsGbeiqfR8jeK4"}}
     * @response 404 scenario="new password" {"state": false,"code": "404","message": "لا يوجد مستخدم بهذا البريد الإلكتروني","execution": "0.297 seconds"}
     * @urlParam lang The language. Example: en
     * @bodyParam email string required The email of user  . Example: Exemple@exemple.com
     * @bodyParam password string required The new password of user  . Example: Exemple1233
     *
     */

    public function newPassword(Request $request)
    {
        $user =   User::where('email', $request->email)->first();
        if (!$user) return response()->error(HttpCodes::NOT_FOUND, __('There is no user with this email'));

        $user->password =  bcrypt($request->password);
        $user->save();
        $token = $user->createToken('app_token');

        return response()->data(['id' => $token->accessToken->id, 'token' => $token->plainTextToken], __('password was changed successfully'));
    }
    /**
     * user profile
     *
     *  If  request have param ' email ' exist and everything is okay, you'll get a 200 OK response.
     *
     *
     * @response 200 scenario="profile" {"data":{"username":"jaafar","email":"admin@gmail.com","nationality":"Kingdom of Saudi Arabia","residence":"Sultanate of Oman","currency":"aed","addresse":"","phone":"+9630936950834","avatar":null,"lang":"en","sex":"male","purchases":5}}
     *
     * @urlParam lang The language. Example: en
     *
     * @authenticated
     *
     *
     *
     */
    public function profile()
    {
        $user   =   User::findOrFail(auth()->id());

        return new UserResource($user);
    }
    /**
     * user profile update
     *
     *  send the field user wont update
     *
     *
     * @response 200 scenario="profile updated" {"state":true,"code":"200","message":"user profile successfly updated","execution":"0.264 seconds","data":[]}
     *
     * @urlParam lang The language. Example: en
     *
     * @bodyParam phone string  The phone of user  . Example: +9941310113
     *
     * @bodyParam allow_notifications boolean  allow notifecations for user
     * @authenticated
     */

    public function update(UserUpdateRequest $request)
    {
        $user = User::findOrFail(auth()->id());

        request('nationality_id')                   ?       $user->nationality_id   =   request('nationality_id') :   false;
        request('firstname')                         ?       $user->firstname         =   request('firstname') :   false;
        request('lastname')                         ?       $user->lastname         =   request('lastname') :   false;
        request('email')                            ?       $user->email            =   request('email')   :   false;
        request('residence_id')                     ?       $user->residence_id     =   request('residence_id') :   false;
        request('addresse')                         ?       $user->addresse         =   request('addresse') :   false;
        request('currency')                         ?       $user->currency         =   request('currency') :   false;
        request('phone')                            ?       $user->phone            =   request('phone')   :   false;
        request('avatar')                           ?       $user->avatar           =   str_replace('public', 'storage',  request('avatar')->storePublicly('avatars')) :   false;
        request('lang')                             ?       $user->lang             =   request('lang') :   false;
        request('sex')                              ?       $user->sex              =   request('sex')   :   false;
        request('allow_notifications')              ?       $user->allow_notifications  =  boolval(request('allow_notifications'))  :   false;

        $user->save();

        return response()->message(__('user profile successfly updated'));
    }


    /**
     * user purchase
     *
     *  If  request have param ' cart and payment_id and amount ' exist and everything is okay, you'll get a 201 OK response.
     *
     *
     * @response 201 scenario="purchase" {"data":{"transaction_id":"ch_3KmcRyHBm3O5wniB0TUIofgp","amount":500,"currency":"AED","created_at":"04/09/2022","cart":[{"name_en":"enim","name_ar":"الاسم ","price":235,"currency":"aed","quantity":2}],"coupons":[{"key":"U-443372-11273-1","participate_with":6,"created_at":"04/09/2022 11:04:31","product":{"name_ar":"الاسم ","name_en":"enim","image":"http://safaqatek.test/images/product/product_00.jpg","closing_at":"05/05/2022 09:05:47","price":235,"currency":"aed"}}]}}
     *
     * @urlParam lang The language. Example: en
     *
     *
     * @authenticated
     *
     * @bodyParam cart object required The Customer purchases  exempele [{"id":1,"quantity":2}] . Example: [{"id":1,"quantity":2}]
     * @bodyParam is_donate boolean if user choise to donate. Example: false
     * @bodyParam lat string The location lat .
     * @bodyParam lng string The location long .
     */


    public function purchase(PurchaseRequest $request)
    {
        try {

            $payment = auth()->user()->charge(
                (request('amount') * 100),
                request('payment_id'),
                ['currency' => auth()->user()->currency ?? 'AED']
            );

            $payment = $payment->asStripePaymentIntent();

            $order = auth()->user()->orders()->create([
                'transaction_id' =>  $payment->charges->data[0]->id,
                'amount' => $payment->charges->data[0]->amount / 100,
                'lng'    => request('lng'),
                'lat'    => request('lat'),
                'currency'    => auth()->user()->currency ?? 'AED',
                'is_donate'   => request('is_donate') ?? false
            ]);

            foreach (json_decode(request('cart'), true) as $item) {
                $order->products()
                    ->attach($item['id'], ['quantity' => $item['quantity']]);
                $copon_per_unit = Product::whereId($item['id'])->pluck('coupon_per_unit')->first();

                auth()->user()->coupons()->create([
                    'product_id' => $item['id'],
                    'order_id' => $order->id,
                    'key' => generateKey(),
                    'participate_with' =>  $item['quantity'] * $copon_per_unit
                ]);
            }

            $order->load('products:id,name_en,name_ar,price', 'coupons.product:id,name_en,name_ar,image,price,closing_at,created_at');
            return new OrderResource($order);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * user coupons
     *
     * @response 200 scenario="coupons are exist" {"data": [{"key": "H-427379-12334-4","participate_with": 6,"created_at": "04/08/2022 12:04:44","product": {"name_ar": "الاسم ","name_en": "ut","image": "http://safaqatek.test/images/product/product_00.jpg",  "closing_at": "05/24/2022 09:05:39","price": 201,"currency": "aed"}}]}
     * @authenticated
     *

     */


    public function coupons()
    {

        $coupon = Coupon::whereUserId(auth()->id())
            ->with('product')
            ->withExists('iswinner as isWinner')
            ->latest()->get();

        return CouponResource::collection($coupon);
    }


    /**
     *  save notifications
     *

     * @authenticated
     *
     *
     * @bodyParam title string The title of notification .
     * @bodyParam body string The body of notifcation.
     */


    public function notificationCreate(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',

        ]);

        return Notification::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'body' => request('body'),
        ]);
    }



    /**
     * get notifications
     *
     * @authenticated
     *
     */

    public function notifications(Request $request)
    {
        $notification =  Notification::select('title', 'body', 'created_at')
            ->whereUserId(auth()->id())
            ->latest()
            ->simplePaginate(20);

        return NotificationResource::collection($notification);
    }
    /**
     * user wishlist
     *
     * @response 200 scenario="wishlists are exist" {"data":[{"id":1,"name_en":"enim","name_ar":"الاسم ","award_name_ar":"أسم الجائزة بالعربي","award_name_en":"numquam","price":235,"currency":null,"image":"http://safaqatek.test/images/product/product_00.jpg","quantity":200,"sold_out":133}]}
     * @authenticated
     *
     */

    public function wishLists()
    {
        $userWishlist    =    User::select('id')->whereId(auth()->id())
            ->with('wishlists')
            ->first();

        return ProductResource::collection($userWishlist->wishlists);
    }
}
