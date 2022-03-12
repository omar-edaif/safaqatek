<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\RegisterUserRequest;
use App\Http\Resources\api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

/**
 * @group User management
 *
 * APIs for managing users
 */
class AuthApiController extends Controller
{
    /**
     * google apple sign up
     *
     * this route is called when user wont sign with their google or apple
     *
     * @urlParam provider string required must be  google apple .
     * @urlParam lang The language. Example: en
     *
     */

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {

            return response($status = 500)->json(['error' => 'error has detected please make short eveting is okay']);
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
     * @response 200 scenario="new user" {"id": 20,"token": "20|zojdQE05gbfH8S08Pg6gvOqn7cZjzeJisRSR5Sxu"}}
     * @bodyParam password_confirmation  string required The same password that user chose
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
     * @response 200 scenario="login" {"id": 20,"token": "20|zojdQE05gbfH8S08Pg6gvOqn7cZjzeJisRSR5Sxu"}}
     */



    public function login(Request $request)
    {

        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            throw ValidationException::withMessages([
                'data' => ['The provided credentials are incorrect.'],

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
     * @response 200 scenario="logout" {"message": "you are logout now"}}
     */

    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($request->has('token_id')) $user->tokens()->where('id', $request->tokenId)->delete();
        else $user->tokens()->delete();

        return response()->json(['message' => 'you are logout now']);
    }
}
