<?php

namespace App\Http\Controllers\institute;

use App\Http\Controllers\Controller;
use App\Http\Middleware\LogoutUsers;
use App\Models\Institute;
use App\Models\LicensePayment;
use App\Models\Section;
use App\Models\Student;
use App\Models\Itiming;
use App\Models\Isession;
use App\Models\Instructor;
use App\Models\Studentinstallments;
use App\Models\User;
use App\Models\Student_Repeat;
use App\Models\StudentReappear;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use App\Notifications\RegisterNotify;
use App\Http\Controllers\StudentinstallmentsController;
use Illuminate\Support\Facades\Cache;
use App\Models\StudentSubject;
use App\Models\Student_batch;
use DB;
use App\Models\Session;


class InstController extends Controller
{
    public function index(Request $request)
    {

   // dd(date("G:i"));

        //        echo gethostbyaddr($_SERVER['REMOTE_ADDR']);

        // dd($request->all());

        $students = Student::with('user')->get();

         $isessions = Isession::all();
        // $studentinstallmentData = Studentinstallments::all();

         if (auth()->user()->userType !=1) {
            $student_id = [];
              foreach ($students as $key => $stud_value) {
                  if ($stud_value->institute_id != auth()->id()) {
                unset($students[$key]);
                         }
                         else{
                  $student_id[] = $stud_value->id;
              }
              }
         }
     $instructors = Instructor::with('user')->Where("institute_id", auth()->id())->get();

     $date = date('Y-m-d').' 00:00:00';
     $year = date('Y');
     // dd($date);
         $total_amount = Studentinstallments::Where("institute_id", auth()->id())
              ->where('created_at','>',$date)
              ->where(['type' => 1])
              ->get();

            $revenue = 0;
            foreach ($total_amount as $key => $total_value) {
                $revenue += $total_value->amount;
            }
        $userData = Student::with('user')->where('institute_id',auth()->id())->get();
        // dd($userData);
        // /dd($userData);
        $onlineUserId = [];

        foreach ($userData as $key => $user_value) {
            if (Cache::has('online_user'.$user_value->user->id)) {

                $onlineUserId[] = $user_value->user->id;
            }
            // dd($onlineUserId);
        }

        if (auth()->user()->userType == 2) {

                   $auth_id = auth()->id();
                }
                else{

                    $auth_id = auth()->user()->instructor->institute_id;
          }

        $onlineUser = User::whereIn('id',$onlineUserId)->get();

        $students = Student::with('user')->Where("institute_id", $auth_id)
        ->where('year',$year)
        ->get();

         $student_repeat = Student_Repeat::where('institute_id',$auth_id)
          ->where('year',$year)
          ->get();

        if (isset($request->isession_id) && !empty($request->isession_id) && isset($request->year) && !empty($request->year)) {

            $students = Student::with('user')
            ->where(['isession_id'=>$request->isession_id,'year'=>$request->year])
            ->where('institute_id', $auth_id)
            ->get();

            $student_repeat = Student_Repeat::where('institute_id',$auth_id)
            ->where(['isession_id'=>$request->isession_id,'year'=>$request->year])
               ->get();

        }

        $stud_reappear = StudentReappear::Where("institute_id", auth()->id())
        ->where('year',$year)
        ->get();

        $regular_student = count($stud_reappear) + count($students);

        foreach ($students as $key => $student) {
             $feesData = $this->feesDetail($student->user_id);
             $student->totalfees = $feesData['fess'];
             $student->paidfees = $feesData['paid_fess'];
             $student->unpaidfees = $feesData['unpaid_fess'];
             $student->nextinstallmentDate = $feesData['nextinstallmentDate'];
            $student->date = $feesData['date'];
             // $students_value->revenue = $feesData['revenue'];
         }

//        if($request->has('view_deleted')){
////            $stud = Student::onlyTrashed()->get();
//
//            $students = Student::with('user')->Where("institute_id", $auth_id)
//                ->where('year',$year)
//                ->onlyTrashed()
//                ->get();
//
//
        //    dd($students);
//        }

//          dd($students);

         // dd($student->nextinstallmentDate);
           // dd($date);
          $custemNotification = DB::table('notifications')
          ->Where('notifiable_id' ,auth()->id())->where('type','App\Notifications\CustemNotification')
          ->latest()->get();

            foreach ($custemNotification as $key => $custem_value) {

                // $type_str = str_replace('\\',' ',$custem_value->type);

                // $type = explode(' ', $type_str);

                // $custem_value->type = $type[2];
                //dd($custem_value);

                $data = json_decode($custem_value->data);

                $custem_value->data = $data->message;

                $custem_value->subject = $data->subject;

                $custem_value->name = $data->name;
                // dd($custem_value->created_at);

                // Carbon::today()->toDateString();
            }

            // dd($custemNotification);

          $userData = User::where('userType',1)->first();

          // dd($userData->name);
             $show_msg = '';

        for ($i=0; $i < count($custemNotification); $i++) {

              $show_msg =  $custemNotification[0];
            # code...
        }
   $currentdata = date('m');

               // $isessions = Isession::all();
        header("Refresh:30");
//        return back();

        return view('instituteadmin.dashboard',compact('students','instructors', 'revenue','isessions','date','onlineUser', 'custemNotification','currentdata','show_msg','userData','student_repeat','regular_student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('instituteadmin.profile');
    }

       public function checknotice(Request $request)
    {
          $custemNotification = DB::table('notifications')
          ->Where('notifiable_id' ,auth()->id())->where('type','App\Notifications\CustemNotification')
          ->get();
          // $notice = [];

          //   foreach ($custemNotification as $key => $custem_value) {

          //        $notice [] = json_decode($custem_value->data);

          //   }

          //   dd($notice);
        return view('instituteadmin.checknotice',compact('custemNotification'));
    }

    public function feesDetail($id)
    {
        $data = array();

        $userData = User::with('student')->find($id);

       // dd($students_value->id);

        if (!is_null($userData)) {

            // fees details
    $total = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 2])->first();

    $paid = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 1])->get();

    $paid_amount = 0;
    foreach ($paid as $key => $paid_value) {
        $paid_amount += $paid_value->amount;
    }

    $unpaid = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 2])->get();

    $unpaid_amount = 0;
    foreach ($unpaid as $key => $unpaid_value) {
        (int)$unpaid_amount += (int)$unpaid_value->amount;
        
    }

      $nextinstallmentDate = Studentinstallments::where(['student_id' => $userData->student->id])
      ->where(['type' => 1])
      ->latest()
      ->pluck('next_installmentdate')
      ->first();

            $created_at = Studentinstallments::where(['student_id' => $userData->student->id])
                ->where(['type' => 1])
                ->latest()
                ->pluck('created_at')
                ->first();

//            $dd = explode(",",$nextinstallmentDate);
//            $posts = Post::whereDate('created_at', Carbon::today())->get();
        // dd($total->amount);

    $userData['fess'] =  $total->amount;
    $userData['paid_fess'] =  $paid_amount;
    $userData['unpaid_fess'] =  $unpaid_amount - $paid_amount;
    $userData['nextinstallmentDate'] =  $nextinstallmentDate;
            $userData['date'] =  $created_at;
     // $userData['revenue'] =  $revenue;

            return $userData;
        }
    }

    public function lock($id){
        $user =User::find($id);
//
        $data =  $user->update(['typing_id' => 1]);

        return redirect()->route('instituteadmin.dashboard');
//        return view('instituteadmin.dashboard');

    }

    public function unlock($id){
        $user =User::find($id);
//
        $data =  $user->update(['typing_id' => null]);
//dd('ll');
        return redirect()->route('instituteadmin.dashboard');
//        return view('instituteadmin.dashboard');
    }

    public function timetable()
    {

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
         }
         else{

             $auth_id = auth()->user()->instructor->institute_id;
         }


        $Itiming = Itiming::where('institute_id', $auth_id)->get();

        $student_id = Student::where('institute_id',$auth_id)->pluck('user_id');
        $studid = Student::where('institute_id',$auth_id)->pluck('id');


        $custem = DB::table('sessions')->whereIn('user_id',$student_id)
        ->get();

        $custem_id = DB::table('sessions')->whereIn('user_id',$student_id)
        ->pluck('user_id');

        $student = Student::where('institute_id',$auth_id)->whereIn('user_id',$custem_id)->get();

        $studentnotlogin = Student::where('institute_id',$auth_id)->whereNotIn('user_id',$custem_id)->get();

        $student_batch =Student_batch::whereIn('student_id',$studid)->get();

    //    $d = Session::all();

        // dd($custem_id);

        header("Refresh:30");

        return view('instituteadmin.timetable',compact('Itiming','custem','student','studentnotlogin','student_batch','student_id','custem_id'));
    }
}
