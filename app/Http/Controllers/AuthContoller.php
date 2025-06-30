<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Hash;

class AuthContoller extends  BaseController
{
    public function login()
    {
        //dd(Hash::make(123456));
        if (!empty(Auth::check())) {
            return redirect('panel/dashboard');
        }

        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect('panel/dashboard');
        } else {
            return redirect()->back()->with('error', 'plase enter currect email or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}
