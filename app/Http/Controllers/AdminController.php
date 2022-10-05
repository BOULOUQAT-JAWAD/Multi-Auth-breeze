<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


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

    public function create(){

        return view('admin.create');

    }

    public function store(Request $request){
        $request->validate([
            '_token' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password =Hash::make( $request->password);

        $admin->save();

        return redirect()->route('admin.create')->with('success','admin created successfully');
    }
}
