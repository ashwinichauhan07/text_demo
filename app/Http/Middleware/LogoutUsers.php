<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class LogoutUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    // {
    //     $user = Auth::user();

    //     if ($user != null){
    //         if ($user->typing_id == 1) {
                   
    //             $request->session()->invalidate();
                        
    //             $request->session()->regenerateToken();
            
    //             return redirect('/');
    //         }
    //     }
    //     return $next($request);
    // }

    
    {
        // session()->forget('lastActivityTime');

        if (! session()->has('lastActivityTime')) {
            session(['lastActivityTime' => now()]);
        }

        // dd(
        //     session('lastActivityTime')->format('Y-M-jS h:i:s A'),
        //     now()->diffInMinutes(session('lastActivityTime')),
        //     now()->diffInMinutes(session('lastActivityTime')) >= config('session.lifetime')
        // );

        if (now()->diffInMinutes(session('lastActivityTime')) >= (config('session.lifetime') - 1) ) {
            if (auth()->check() && auth()->id() > 1) {
               $user = auth()->user();
               auth()->logout();

               $user->update(['is_logged_in' => false]);
               $this->reCacheAllUsersData();

               session()->forget('lastActivityTime');

               return redirect(route('users.login'));
           }

       }

       session(['lastActivityTime' => now()]);

       return $next($request);
    }

}
