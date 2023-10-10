<?php

namespace App\Http\Middleware;

use App\Models\Isession;
use App\Models\LicensePayment;
use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use App\Models\Studentinstallments;
use App\Models\Student_batch;
use App\Models\Itiming;

class UserTypeCheck
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
        if (auth()->user()->userType == 1) {
            return redirect('admin/dashboard');
        } elseif (auth()->user()->userType == 2) {
            return redirect('instituteadmin/dashboard');
        } elseif (auth()->user()->userType == 3) {
            return redirect('instructortadmin/dashboard');
        }elseif (auth()->user()->userType == 4) {

            $id = Student::where('user_id', auth()->id())->first();

            $nextinstallmentDate = "";

//             //            for purchase license
//             $check_payment = LicensePayment::where('student_id', $id->id)->get();

//             if (count($check_payment) > 0) {
//                 $session = Isession::where('active', 1)->get()->pluck('id');
//                 $current_year = date('Y');
//                 $check_session = Student::where('user_id', auth()->id())->whereIn('isession_id', $session)->where('year', $current_year)->first();

// //                    dd($session );
//                 if ($check_session != null) {

                    $studentData = Studentinstallments::where('student_id', $id->id)
                        ->where(['type' => 1])
                        ->latest()

                        ->first();

                    if ($studentData != null) {

                        $curretntDate = date('Y-m-d');
                        // $nextinstallmentDate = $studentData->next_installmentdate;

                        if($studentData->next_installmentdate != null){
                            $nextinstallmentDate = date("Y-m-d", strtotime($studentData->next_installmentdate));
                        }
                        else{
                            $nextinstallmentDate = null;

                        }

                        // dd($nextinstallmentDate);

                        if ($nextinstallmentDate != null) {
                            if ($curretntDate <= $nextinstallmentDate) {
                                return redirect('student/dashboard');
                            }
                            else {
                                return back()->with('error', "Please Pay Your Next Installment");
                            }

                        } else {
                            return redirect('student/dashboard');
                        }

                    } else {
                                                //    dd($nextinstallmentDate);

                        return redirect('student/dashboard');
                    }


                // } else {
                //     return back()->with('error', "Your Session Expaired");

                // }

//                 return redirect('student/dashboard');
//             } else {
//                 return back()->with('error', "Contact with your Institute");
//             }


//         }

                return redirect('student/dashboard');

    }
}
}






















//        } elseif (auth()->user()->userType == 4) {
//
//            $id = Student::where('user_id', auth()->id())->first();
//
//            //            for purchase license
//            $check_payment = LicensePayment::where('student_id', $id->id)->get();
//
//            if (count($check_payment) > 0) {
//                $session = Isession::where('active', 1)->get()->pluck('id');
//                $current_year = date('Y');
//                $check_session = Student::where('user_id', auth()->id())->whereIn('isession_id', $session)->where('year', $current_year)->first();
////                    dd($session );
//                if ($check_session != null) {
//                    $studentData = Studentinstallments::where('student_id', $id->id)
//                        ->where(['type' => 1])
//                        ->latest()
//                        ->first();
//
//                    if ($studentData != null) {
//
//                        $curretntDate = date('Y-m-d');
//                        $nextinstallmentDate = $studentData->next_installmentdate;
//                        if ($nextinstallmentDate != null) {
////                            dd($nextinstallmentDate);
//                            if ($curretntDate <= $nextinstallmentDate) {
////                                return redirect('student/dashboard');
//
//                                $studentbatch = Student_batch::where('student_id', $id->id)
//                                    ->pluck('batch_id');
//
//                                $time_data = Itiming::whereIn('id', $studentbatch)->get();
//
//                                $current_time = date(" G:i ");
//
////                        dd($time_data);
//
//                                foreach ($time_data as $key => $value) {
//
//                                    $exlpode_time = explode(":", $value->start_time);
//
//                                    $end_time = $exlpode_time[0] += 1;
//
//                                    $exlpode_current_time = explode(":", $current_time);
//
//                                    $currentTime = $exlpode_current_time[0] += 1;
//
//                                    $batch_time = Itiming::whereBetween('start_time', [$current_time, $currentTime])
//                                        ->where('institute_id', $id->institute_id)
//                                        ->first();
//
//                                    if ($batch_time == null) {
//
//                                        return back()->with('error', "Please Check your Batch Time");
//                                    } else {
//
//                                        $time = Student_batch::where('student_id', $id->id)
//                                            ->where('batch_id',$batch_time->id)->first();
//
////                                dd($time);
//
//                                        if ($time == null) {
//
//                                            return back()->with('error', "Please Check your Batch Time");
//                                        } else {
//                                            return redirect('student/dashboard');
//                                        }
//
//                                    }
//                                }
//
//
//                                $time_data = Itiming::whereIn('id', $studentbatch)->get();
//
//                                $current_time = date(" G:i ");
//                            } else {
//                                return back()->with('error', "Please Pay Your Next Installment");
//                            }
//
//                        } else {
//
//                            return redirect('student/dashboard');
//                        }
//
//                    } else {
//
//                        $studentbatch = Student_batch::where('student_id', $id->id)
//                            ->pluck('batch_id');
//
//                        $time_data = Itiming::whereIn('id', $studentbatch)->get();
//
//                        $current_time = date(" G:i ");
//
////                        dd($time_data);
//
//                        foreach ($time_data as $key => $value) {
//
//                            $exlpode_time = explode(":", $value->start_time);
//
//                            $end_time = $exlpode_time[0] += 1;
//
//                            $exlpode_current_time = explode(":", $current_time);
//
//                            $currentTime = $exlpode_current_time[0] += 1;
//
//                            $batch_time = Itiming::whereBetween('start_time', [$current_time, $currentTime])
//                                ->where('institute_id', $id->institute_id)
//                                ->first();
//
//                            if ($batch_time == null) {
//
//                                return back()->with('error', "Please Check your Batch Time");
//                            } else {
//
//                                $time = Student_batch::where('student_id', $id->id)
//                                ->where('batch_id',$batch_time->id)->first();
//
////                                dd($time);
//
//                                if ($time == null) {
//
//                                    return back()->with('error', "Please Check your Batch Time");
//                                } else {
//                                    return redirect('student/dashboard');
//                                }
//
//                            }
//                        }
//
//
//                        return redirect('student/dashboard');
//                    }
//
//                } else {
//                    return back()->with('error', "Your Session Expaired");
//                }
//                return redirect('student/dashboard');
//            } else {
//                return back()->with('error', "Contact with your Institute");
//            }

//dd('ll');
//            $id = Student::where('user_id',auth()->id())->first();
//
////            dd($id);
//
//            $studentData = Studentinstallments::where('student_id',$id->id)
//            ->where(['type' => 1])
//            ->latest()
//            ->first();


//            dd($studentData);
//            if ($studentData != null) {
//
//                // dd($nextinstallmentDate);
//
//                $curretntDate = date('Y-m-d');
//            $nextinstallmentDate = $studentData->next_installmentdate;
//
//            if ($nextinstallmentDate != null){
//
//
////dd($nextinstallmentDate);
//               if ($curretntDate <= $nextinstallmentDate) {
//
//                 $studentbatch = Student_batch::where('student_id',$id->id)
//                 ->pluck('batch_id');
//
//
//                 $time_data = Itiming::whereIn('id',$studentbatch)->get();
//
//                 $current_time = date(" G:i ");
////dd($time_data);
//                 foreach ($time_data as $key => $value) {
////dd($time_data);
//
//
//               $exlpode_time = explode(":" , $value->start_time);
//
//               $end_time = $exlpode_time[0] += 1;
//
//               $exlpode_current_time = explode(":" , $current_time);
//
//               $currentTime = $exlpode_current_time[0] += 1;
//
//               // dd($current_time);
//
//               $batch_time = Itiming::whereBetween('start_time' ,[$current_time, $currentTime] )
//                             ->where('institute_id',$studentData->institute_id)
//                             ->first();
//
////                              dd($batch_time);
//
//                            if ($batch_time == null) {
//
//                                return back()->with('error',"Please Check your Batch Time");
//                            }
//                            else{
//
//                                $time = Student_batch::where('student_id',$id->id)
////                       ->where('batch_id',$batch_time->id)
//->first();
//
////                                dd($batch_time->id);
//
//                       if ($time == null) {
//
//                          return back()->with('error',"Please Check your Batch Time");
//                       }
//                       else{
//                         return redirect('student/dashboard');
//                       }
//
//                      }
//          }
//
//               }
//
//               else{
//                return back()->with('error',"Please Pay Your Next Installment");
//               }
//
//            }
//
//
//            else{
//
//                return redirect('student/dashboard');
//
//            }
//            }
//
//        }
////         return ('lll');
//    }i
//            return redirect('student/dashboard');

