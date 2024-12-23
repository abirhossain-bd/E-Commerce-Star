<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(){
        if (Auth::user()) {
            return redirect()->route('dashboard');
        }
        return view('admin_panel.auth.register');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3|',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:25',
        ]);
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'created_at' => now(),
        ]);
        return redirect()->route('login')->with('success','Register Successful');
    }
}
