<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;
use Illuminate\Http\Request;
use DB;

class StudentNotice
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


        $user = auth()->user();

        // dd($user);


        if ($user != null) {

            // $id = Student::where('user_id', auth()->id())->first();

                 if ($user->userType == 4) {

                    $custemNotification = DB::table('notifications')
                    ->where('type', "App\Notifications\CustemNotification")
                    ->where('notifiable_id',$user->id)
                    ->get();

                    foreach ($custemNotification as $key => $data_value) {

                        $data = json_decode($data_value->data);

                        $current_date = date('Y-m-d');


                        if($current_date == $data->fdate){

                        if($current_date <= $data->tdate){

                        $Notification = DB::table('notifications')->where('id',$data_value->id)->update([
                        'read_at' => NULL
                        ]);

                        }

                    }
                    else{

                        $Notification = DB::table('notifications')->where('id',$data_value->id)->update([
                            'read_at' => $current_date
                            ]);

                    }


                    }
            }

        }
        return $next($request);
    }
}
