<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginform(){
        return view('admin.loginform');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function login(){
        print 'login process';
    }
}
