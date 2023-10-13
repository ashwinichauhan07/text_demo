<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Institute;
use App\Models\Instructorpayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use App\Notifications\RegisterNotify;
use App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Cache;


class AdmininstructorController extends Controller
{
    public function index()
    {
        $custemNotification = DB::table('notifications')
         ->Where('notifiable_id' ,auth()->id())
        ->latest()->get();


        // if($custemNotification != null){

        $custem_value = [];

            foreach ($custemNotification as $key => $custem_value) {

                // $type_str = str_replace('\\',' ',$custem_value->type);

                // $type = explode(' ', $type_str);

                // $custem_value->type = $type[2];
                //dd($custem_value);

                $data = json_decode($custem_value->data);

                $custem_value->data = $data->message;

                $custem_value->subject = $data->subject;

                $custem_value->name = $data->name;


            }



        // $custem_value = [];

        // foreach ($custemNotification as $key => $value) {

        //     $custem_value [] = $value->data;

        //     // dd($value);
        // }

        $show_msg = '';

        for ($i=0; $i < count($custemNotification); $i++) {

              $show_msg =  $custemNotification[0];
            # code...
        }




        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

//        dd($auth_id);


        $students = Student::with('user')->Where("institute_id", $auth_id)->get();

        $instructorPayment = [];

        $instructorPayment = Instructorpayment::with('instructor')
                             ->Where('name',auth()->id())
                             ->first();

                            // dd($instructorPayment->instructor->identity_img);
        // $student_data = Student::with('user')->where('institute_id',auth()->id())->get();



        $instructorData = Instructor::with('user')->where('institute_id',$auth_id)->get();

        // $instructorData = User::where('userType',4)->get();

        // dd($data);

        $student =[];

        foreach ($students as $key => $value) {

             $student [] = $value->institute_id;
        }

        // dd($student);

        $instructor = [];

        foreach ($instructorData as $key => $value) {

             $instructor [] = $value->institute_id;
        }

         $instituteData = Institute::with('user')->whereIn('user_id',$student)->OrwhereIn('user_id',$instructor)->first();

         // dd($instituteData);

        return view('instructortadmin.index',compact('students','instructorPayment','custemNotification','custem_value','show_msg','instituteData'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('instructortadmin.profile');
    }

    public function payment()
    {

         if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $students = Student::with('user')->Where("institute_id", $auth_id)->get();

        $instructorPayment = [];

        $instructorPayment = Instructorpayment::with('instructor')
                             ->Where('name',auth()->id())
                             ->Where('institute_id',$auth_id)
                             ->get();

                             // dd($instructorPayment);

        return view('instructortadmin.payment',compact('instructorPayment'));
    }


       public function checknotice(Request $request)
    {

          $custemNotification = DB::table('notifications')
          ->Where('notifiable_id' ,auth()->id())
          ->get();


          // $notice = [];

          //   foreach ($custemNotification as $key => $custem_value) {

          //        $notice [] = json_decode($custem_value->data);

          //   }



          //   dd($notice);

        return view('instructortadmin.checknotice',compact('custemNotification'));
    }
}

