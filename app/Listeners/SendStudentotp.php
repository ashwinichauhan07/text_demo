<?php

namespace App\Listeners;

use App\Events\Studentotp;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendStudentotp
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
     * @param  Studentotp  $event
     * @return void
     */
    public function handle(Studentotp $event)
    {
        $number = mt_rand(0, 9999);

        $details =[

            'otp'=>$number,
            'body'=>'Thank You!'
        ];

//         dd($event->student->email);

        $user = User::where('email',$event->student->email)->update(['otp' => $details['otp']]);

//        mail::to($event->user->email)->send(new VerifyOtp($details));
    }
}
