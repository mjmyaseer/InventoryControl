<?php

namespace App\Http\Controllers\User;

use App\Http\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    //Define controller actions

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('user.login');
    }

    public function details(Request $request)
    {
        $userRole = $request->session()->get('role');

        if ($userRole != 1) {
            flash()->error('You are not Authorized');
            return redirect('secure/dashboard.html');
        }

        $users = User::all();
        return view('user.index')->with('users', $users);
    }

    public function view($id)
    {
        return "VIEW USER -- {$id}";
    }

    /**
     * @param null $id
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getupdateUser($id = null, Request $request)
    {
        $userRole = $request->session()->get('role');

        if ($userRole != 1) {
            flash()->error('You are not Authorized');
            return redirect('secure/dashboard.html');
        }

        if ($id == null || $id == '') {
            $id = $request->session()->get('userID');
        }

        $user = User::where("id", $id)->first();
//        dd($user);
        $data = array(
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'role' => $user->role);

        return view('user.profile')->with('user', $data);
    }

    public function saveUser($id = null, Request $request)
    {
        app('db')->beginTransaction();

        $data = $request->all();

        try {
            if ($id != null || $id != "") {
                $user = $this->user->where('id', $id)->first();
            } else {
                $user = new User;
            }

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->role = $data['role'];
            $user->created_by = $request->session()->get('userID');
            if (isset($data['password']) && !empty($data['password']) && $data['password'] != null) {
                $user->password = $data['password'];
            } else {
                $user->password = $user->password;
            }
            $status = $user->save();

            app('db')->commit();

            if ($status) {
                flash()->success('Changes Successfully Commited');
                return Redirect::to('secure/users');
            }

        } catch (\Exception $ex) {

            app('db')->rollback();

            flash()->success($ex->getMessage());

        }
    }

    public function updateCurrentUser(Request $request)
    {
        app('db')->beginTransaction();

        $data = $request->all();

        try {
            $id = $request->session()->get('userID');
            $user = $this->user->where('id', $id)->first();

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->role = $data['role'];
            $user->created_by = $request->session()->get('userID');
            if (isset($data['password']) && !empty($data['password']) && $data['password'] != null) {
                $user->password = bcrypt($data['password']);
            } else {
                $user->password = $user->password;
            }
            $status = $user->save();

            app('db')->commit();

            if ($status) {
                flash()->success('Changes Successfully Commited');
                return Redirect::to('secure/users');
            }

        } catch (\Exception $ex) {

            app('db')->rollback();

            flash()->success($ex->getMessage());

        }
    }

    public function addUser()
    {
        return view('user.profile');
    }
}
