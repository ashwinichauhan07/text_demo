<?php

namespace App\Http\Controllers;

use App\Events\Studentotp;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RegisterEvent;
use App\Mail\verifyOtp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use function PHPUnit\Framework\isNull;
use App\Events\OtpEvent;


class AuthController extends Controller
{

    public function login(){

        return view('auth.login');
    }

    public function store(Request $request){

         // dd('kkk');

            $userData = request()->validate([
            'email' =>'required|email',
            'password' => 'required',

         ]);

         $user =User::where('email',$request->email)->where('userType',1)->first();



         // dd($user);
          // if ($user == true) {
           $credentials = $request->only('email', 'password');  



        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'userType' => 1])) {
            $request->session()->regenerate();

                event(new OtpEvent($user));

                return redirect()->intended('sendOtp');

            }

         elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'userType' => 2])) {

                return redirect()->route('instituteadmin.dashboard');
            }
        elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'userType' => 3])) {

                return redirect()->route('instructortadmin.dashboard');
            }
        elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'userType' => 4])) {

            // dd("kk");

//dd('ll');
            $student =User::where('email',$request->email)->where('userType',4)->first();

            event(new Studentotp($student));

                return redirect()->route('dashboard');
            }
// }
        return redirect()->route('auth.login')->with('status','The provided credentials do not match our records.');

}


    public function sendOtp (Request $request)
    {
        return view('auth.verifyOtp');
    }

      public function otpvarify(Request $request)
    {

        // dd('ui');
      $otp = User::where('email',$request->email)
               ->where('otp',$request->otp)
               ->first();

               // dd($otp);
       if ($otp == true) {
                  return redirect()->route('admin.dashboard');
              }

        return redirect()->route('sendOtp')->with('status','Incorrect otp');

    }

    // public function verifyOtp (Request $request)
    // {
    // 	$data = [];

    // 	$validator = Validator::make($request->all(),[
    // 		'token' => 'required',
    // 		'email' => 'required|email',
    //         'password' => 'required',
    // 	]);

    // 	$credentials = $request->only('email','password','token');

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'userType' => 1, 'token' => $request->token])) {

    //         //dd($userData);

    //         return redirect()->route('auth.verify');
    //     }
    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }

    // public function verify (Request $request)
    // {
    //     $data = [];

    //     $validator = Validator::make($request->all(),[
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'token' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password', 'token');

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'userType' => 1, 'token' => $request->token])) {

    //         return redirect()->intended('admin.dashboard');
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }

                public function logout(Request $request) {

                    // dd(auth()->id());
                User::where('id',auth()->id())->update(['otp' => null]);
                Auth::logout();
                return redirect('/');
            }



}
