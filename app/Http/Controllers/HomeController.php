<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login(){
        return view('login');
    }
    public function postLogin(){
        return view('login');
    }
    public function register(){
        return view('register');
    }
    public function postRegister(){
        return view('login');
    }
}
