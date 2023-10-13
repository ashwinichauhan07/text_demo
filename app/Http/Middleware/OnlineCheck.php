<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;

class OnlineCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        if (auth()->check()) {
            // Cache::put(key: 'online_user'.auth()->id(), value:true,now()->addMinutes( value:1 ));
            Cache::put('online_user' . auth()->id(), true, now()->addMinute(2));



            // dd($custem);

    //             $ip_address = file_get_contents('http://checkip.dyndns.com/');
    //
    //             $ip_address = explode(" ", $ip_address);
    //
    ////             dd($ip_address);
    //
    //             Cache::put('ip'.auth()->id(),$ip_address[5],now()->addMinutes(1));
        }

        return $next($request);
    }
}


