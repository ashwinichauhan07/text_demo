<?php

namespace App\Http\Middleware;

use App\Models\Itiming;
use App\Models\Student;
use App\Models\Student_batch;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStudentBatch
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

        $id = Student::where('user_id', auth()->id())->first();

        if ($user != null) {

            if ($user->userType == 4) {
//            dd($id);

                $studentbatch = Student_batch::where('student_id', $id->id)
                    ->pluck('batch_id');


                $time_data = Itiming::whereIn('id', $studentbatch)->get();

                $current_time = date(" G:i ");

                     

                foreach ($time_data as $key => $value) {

                    $exlpode_time = explode(":", $value->start_time);

                    $end_time = $exlpode_time[0] += 1;

                    $exlpode_current_time = explode(":", $current_time);

                    $currentTime = $exlpode_current_time[0] += 1;

                    // dd($current_time);

                    $batch_time = Itiming::whereBetween('start_time', [$current_time, $currentTime])
                        ->where('institute_id', $id->institute_id)
                        ->first();

                        // dd($batch_time);

                    if ($batch_time == null) {
                        
                        $request->session()->invalidate();
                        
                        $request->session()->regenerateToken();
                    
                        return redirect('/')->with('error', "This is not your Batch Time");;

                        
                    } else {

                        $time = Student_batch::where('student_id', $id->id)
                            ->where('batch_id', $batch_time->id)->first();


                        if ($time == null) {

                            $request->session()->invalidate();
                        
                            $request->session()->regenerateToken();
                        
                            return redirect('/')->with('error', "This is not your Batch Time");;
                        }

                    }
                }
            }
        }
        return $next($request);
    }
}
