<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class DemoExam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

    //     $user = auth()->user();

    //     if ($user != null) {

    //         if ($user->userType == 2) {

    //             $response = Http::get('http://192.168.29.7/eswift/api/insert_absentattendance');

                return $next($request);
    //     }
    // }





    }
}
