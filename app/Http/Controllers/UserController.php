<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index(){
        return view('login');
    }

    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
        ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user() -> role == 'admin'){
                return redirect('/admin');
            }elseif(Auth::user() -> role == 'user'){
                return redirect('/admin');
            }
        }else{
            return redirect('')->withErrors('Username atau Password Salah')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }
}
