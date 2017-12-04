<?php

namespace App\Http\Controllers\Auth;

use \App\Http\Models\User;
use App\Http\Models\AuthToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use \Config;
use \Exception;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request)
    {
        $userRole = $request->session()->get('role');

        if ($userRole != 1) {
            flash()->error('You are not Authorized');
            return redirect('secure/dashboard.html');
        }

        $users = User::all();
        return view('user.index')->with('users', $users);
    }

    public function newUser(Request $request)
    {

        $validationRules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ];

        if (!isset($id)) {
            $validationRules['first_name'] = 'required|unique:' . User::TABLE . ',first_name';
            $validationRules['email'] = 'required|unique:' . User::TABLE . ',email';
        }
        $this->validate($request, $validationRules);

        //Add New User To the System
        try {
            $user = new User();
            $existUser = $user->getUserByEmail($request->email);
            if ($existUser != NULL) {
                return response()->json([
                    'status' => 'FAILED',
                    'error' => Config::get('custom_messages.USER_ALREADY_EXIST')
                ]);
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->created_by = $request->session()->get('userID');

            if ($user->save()) {
                $auth_token = new AuthToken();
                $auth_token->user_id = $user->id;
                $auth_token->token = md5(time());
                $auth_token->save();

                $user->token = $auth_token->token;

                unset($user->id);
                unset($user->created_at);
                unset($user->updated_at);
                unset($user->password);
                unset($user->email);
                unset($user->role);

                $users = User::all();

                flash()->success('User Created Successfully');

                return view('user.index')->with('users', $users);
            }
            flash()->error('Error Creating User');

        } catch (Exception $e) {
            Log::error($e->getMessage());

            flash()->error($e->getMessage());
        }
        $this->redirectTo;
    }



    public function signUp()
    {
        return view('user.sign-up');
    }

}
