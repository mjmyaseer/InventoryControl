<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\AuthToken;
use App\Http\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use \Config;
use \Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    public function doLogin(Request $request)
    {
        if (!$request->has('email')) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.EMAIL_REQUIRED')
            ]);

        }
        if (!$request->has('password')) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.PASSWORD_REQUIRED')
            ]);

        }

        $user = new User();

        $existingUser = $user->getUserByEmail($request->email);

        if ($existingUser == NULL) {
            return response()->json([
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.USER_DOES_NOT_EXIST')
            ]);
        }

        if (!Hash::check($request->password, $existingUser->password)) {
            return [
                'status' => 'FAILED',
                'error' => Config::get('custom_messages.INVALID_PASSWORD')
            ];
        }

        $request->session()->put('userFirstName', $existingUser->first_name);
        $request->session()->put('userLastName', $existingUser->last_name);
        $request->session()->put('userID', $existingUser->id);
        $request->session()->put('email', $existingUser->email);
        $request->session()->put('role', $existingUser->role);

        $auth_token = new AuthToken();
        $auth_token->user_id = $existingUser->id;
        $auth_token->token = md5(time());
        $auth_token->save();

        unset($existingUser->id);
        unset($existingUser->created_at);
        unset($existingUser->updated_at);
        unset($existingUser->password);
        unset($existingUser->email);

        $existingUser->token = $auth_token->token;

        return response()->json([
            'status' => 'SUCCESS',
            'user' => $existingUser
        ]);
    }

    public function doLogout(Request $request)
    {
        $request->session()->flush();

        return Redirect::to('sign-in.html');
    }
}
