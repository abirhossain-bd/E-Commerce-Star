<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function login(){
        if (Auth::user()) {
            return redirect()->route('dashboard');
        }
        return view('admin_panel.auth.login');
    }

    public function signin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')->with('success','Login Successful');
        }

        return back()->with('error','Credential does not match!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Logout Successful');
    }
}
