<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class DemoauthController extends Controller
{
    public function login(){

        return view('demoexam.auth.login');
    }

    public function store(Request $request){


           $userData = request()->validate([
           'email' =>'required|email',
           'password' => 'required',

        ]);

        $user =User::where('email',$request->email)->where('userType',1)->first();



        // dd($user);
         // if ($user == true) {
          $credentials = $request->only('email', 'password');

       if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'userType' => 2])) {

        // dd($credentials);

             return redirect()->route('demoexam.dashboard');

           }


       return redirect()->route('auth.login')->with('status','The provided credentials do not match our records.');

}

}
