<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\user;

class AuthController extends Controller
{
    public function adminlogin()
    {
        return view('admin.loginadmin');
    }

    public function login()
    {
        return view('login.login');
    }

    public function register()
    {
        return view('login.register');
    }



    public function postlogin(Request $request)
    {
        $login = $request->only(['email', 'password']);

        if (Auth::guard('web')->attempt($login)) {
            return redirect('/users/home');
        } else {
            return redirect('/login');
        }

        return redirect('/login');
    }

    public function postloginAdmin(Request $request)
    {
        $admin = $request->only(['username', 'password']);
        if (Auth::guard('admin')->attempt($admin)) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/adminlogin');
        }

        return redirect('/adminlogin');
    }

    

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
