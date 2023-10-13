<?php

namespace App\Listeners;

use App\Events\OtpEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyOtp;
use App\Models\User;

class OtpListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OtpEvent  $event
     * @return void
     */
    public function handle(OtpEvent $event)
    {
        // dd('kl');
        $number = mt_rand(0, 9999);

       $details =[
            'otp'=>$number,
            'body'=>'Thank You!'
        ];
      // dd($event);
      $user = User::where('email',$event->user->email)->update(['otp' => $details['otp']]);

      mail::to($event->user->email)->send(new VerifyOtp($details));
    }
}
