<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginform(){
        return view('admin.loginform');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function login(Request $request){
        if(Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            return redirect()->route('admin.dashboard')->with("success","you're logged in");
        }
        return back()->with('error','Invalid Email or Password');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.loginform')->with("success", "you're logged out successfully");
    }
}
