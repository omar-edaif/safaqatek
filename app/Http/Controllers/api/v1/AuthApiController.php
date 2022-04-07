<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\HttpCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\LoginUserRequest;
use App\Http\Requests\user\PurchaseRequest;
use App\Http\Requests\user\RegisterUserRequest;
use App\Http\Resources\api\UserResource;
use App\Models\Product;
use App\Models\User;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
            'username'  => $request->username,
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

        $user = User::where('email', $request->email)->first();

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
     * @response 200 scenario="profile" {"state":true,"code":"200","message":"password was changed successfully","execution":"0.349 seconds","data":{"id":36,"token":"36|yAhv3yRnNyhJ9lwaPDA4uqVnc0nsGbeiqfR8jeK4"}}
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
     * user purchase
     *
     *  If  request have param ' cart and payment_id and amount ' exist and everything is okay, you'll get a 200 OK response.
     *
     *
     * @response 200 scenario="purchase"
     *
     * @urlParam lang The language. Example: en
     *
     *
     * @authenticated
     *
     */


    public function purchase(PurchaseRequest $request)
    {

        try {

            $payment = auth()->user()->charge(
                $request->input('amount'),
                $request->input('payment_method_id'),
                ['currency' => auth()->user()->currency ?? 'AED']
            );

            $payment = $payment->asStripePaymentIntent();

            $order = auth()->user()->orders()
                ->create([
                    'transaction_id' =>  $payment->charges->data[0]->id,
                    'amount' => $payment->charges->data[0]->amount,
                    'lng'    => $request->input('lng'),
                    'lat'    => $request->input('lat'),
                    'currency'    => $request->input('currency') ?? 'AED',
                    'is_donate'   => $request->input('is_donate') ?? false
                ]);

            foreach (json_decode($request->input('cart'), true) as $item) {
                $order->products()
                    ->attach($item['id'], ['quantity' => $item['quantity']]);
                $copon_per_unit = Product::whereId($item['id'])->pluck('copon_per_unit')->first();

                auth()->user()->coupons()
                    ->create([
                        'product_id' => $item['id'],
                        'order_id' => $order->id,
                        'key' => generateKey(),
                        'participate_with' =>  $item['quantity'] * $copon_per_unit
                    ]);
            }

            $order->load('products', 'coupons');
            return $order;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
