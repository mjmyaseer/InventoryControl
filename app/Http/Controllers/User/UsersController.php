<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //Define controller actions


    public function index()
    {
        return view('user.login');
    }

    public function view($id)
    {
        return "VIEW USER -- {$id}";
    }
}
