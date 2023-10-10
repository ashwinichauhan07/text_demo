<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\Typing_practise_result;
use App\Models\TypingPractise;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Institute;
use App\Models\Homekey;
use App\Models\Upperkey;
use App\Models\language;
use App\Models\HomeKeyResult;
use App\Models\Capitalword;
use App\Models\Lowerkey;
use App\Models\Itiming;
use App\Models\PractiseType;
use App\Models\Student_batch;
use App\Models\Studentinstallments;
use App\Models\Attendance;
use App\Models\TypingWordPractices;
use App\Models\KeboardPractice;
use App\Models\Subject;
use App\Models\LicensePayment;
use App\Models\Typing_test_result;
use App\Models\StudentSession;
use Illuminate\Support\Facades\Validator;




use DB;
use SebastianBergmann\LinesOfCode\Exception;

class StudentuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//dd('jj');

        $student = Student::with('installments')->where('user_id',auth()->id())->first();

        $current_time = date(" y-m-d G:i:s ");

        $exlpode_current_time = explode("-" , $current_time);

        $exlpode_current = explode(' ',$exlpode_current_time[2]);

        $end_time = $exlpode_current[0] -= 1;

        $previoue_date = date(" y-m")."-$end_time ". date("G:i:s ");

//        dd($previoue_date);
        $typing_result = Typing_practise_result::where('student_id',auth()->id())
            ->whereBetween('created_at',[$previoue_date,$current_time])
            ->get();

            $typing_test_result = Typing_test_result::where('student_id',auth()->id())
            ->whereBetween('created_at',[$previoue_date,$current_time])
            ->get();
    //    dd($typing_test_result);
// $data = [];
//
//         foreach ($typing_result as $key => $value) {
//            $data [] =  $value->letter_result;
//         }
//         dd($data);

        $exlpode_current_time = explode("-" , $current_time);

        $exlpode_current = explode(' ',$exlpode_current_time[2]);

        $end_time = $exlpode_current[0] -= 1;

//        dd($end_time);

//        $batch_time = Itiming::whereBetween('start_time' ,[$current_time, $currentTime] )
//            ->where('institute_id',$student_data->institute_id)
//            ->first();

//        $exlpode_time = explode(":" , $value->start_time);
//
//        $end_time = $exlpode_time[0] += 1;
//
//        $exlpode_current_time = explode(":" , $current_time);
//
//        $currentTime = $exlpode_current_time[0] += 1;

        // foreach ($student as $key => $value) {
        //    $data =  $value->student_batch;
        // }

        //   $data_id = [];
        //  foreach ($data as $key => $value) {
        //    $data_id[] =  $value->batch_id;
        // }

        //  $time_data = Itiming::whereIn('id',$data_id)->get();

        // dd($time_data);

        $paid = Studentinstallments::where(['student_id' => $student->id])
            ->where(['type' => 1])->get();


        $paid_amount = 0;
        foreach ($paid as $key => $paid_value) {
            $paid_amount += $paid_value->amount;
        }
        $custemNotification = DB::table('notifications')
            ->Where('notifiable_id' ,auth()->id())
            ->Where('read_at',NULL)->where('type','App\Notifications\CustemNotification')
            ->get();

            // dd($custemNotification);

        $count = 0;
        if(count($custemNotification) > 5) {
            $count = 5;
        } else {
            $count = count($custemNotification);
        }
        // dd($custemNotification);
        return view('studentuser.index12',compact('paid_amount','custemNotification','count','typing_result','typing_test_result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function paidfees()
    {

        $student = Student::with('installments')->where('user_id',auth()->id())->first();

        $paid = Studentinstallments::where(['student_id' => $student->id])
            ->where(['type' => 1])->get();

        $totalfees = Studentinstallments::where(['student_id' => $student->id])
            ->where(['type' => 2])->first();

        $paid_amount = 0;
        foreach ($paid as $key => $paid_value) {
            $paid_amount += $paid_value->amount;
        }

        $balancefees = 0;
        $balancefees = $totalfees->amount - $paid_amount;

        // dd($paid_amount);

        return view('studentuser.paidfees',compact('paid','totalfees','balancefees','paid_amount'));
    }


    public function selectpractise()
    {

        $student = Student::with('institute')->where('user_id',auth()->id())->first();
//
        $subject_arr =[];
        $subjectId =[];

        foreach ($student->student_subject as $key=> $subject_value) {

            if ($subject_value->old == 0) {

                $subject_arr[] = $subject_value;
                $subjectId[] = $subject_value->subject_id;
            }
        }

        $practiseType = PractiseType::where('institute_id',$student->institute_id)
            ->whereIn('subject_id',$subjectId)
            ->get();
//        dd($practiseType);


        $keyboardType = KeboardPractice::where('institute_id',$student->institute_id)
            ->whereIn('subject_id',$subjectId)
            ->get();

        $typingData = TypingPractise::where('institute_id',$student->institute_id)
            ->whereIn('subject_id',$subjectId)
            ->get();

            $payment = [];

        // $payment = LicensePayment::where('institute_id',$student->institute_id)
        //     ->whereIn('subject_id',$subjectId)
        //     ->where('student_id',$student->id)->get();
//         dd($payment);
//
//         $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        return view('studentuser.selectpractise',compact('subject_arr','practiseType','keyboardType','typingData','payment'));
    }

    public function studid($id)
    {

        $data = array();

        $userData = User::with('student')->find($id);
    }

    public function typing(Request $request)
    {

        // dd($request->all());

        // $homekeyData = Homekey::where('institute_id',$student->institute_id)->find($request->id);

        $student_data = Student::where('user_id',auth()->id())->first();

        $typing_data = TypingWordPractices::where('institute_id',
            $student_data->institute_id)->pluck('wordpractice');

// dd($typing_data);


        return view('studentuser.typing',compact('typing_data'));
    }

    public function typing_data(Request $request)
    {

        // dd('ui');

        $data =[];

        $student_data = Student::where('user_id',auth()->id())->first();

        $typingData = TypingWordPractices::where('institute_id',$student_data->institute_id)
            ->pluck('wordpractice');

        return response()->json([
            'status'    => true,
            'message'   => 'typing Data',
            'data'      => $typingData,
        ]);
        // dd($typing_data);

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showattendanse()
    {

        $student_id =Student::where('user_id',auth()->id())->first();

//        dd($student_id);
        $attendanse_data = Attendance::where('student_id',$student_id->id)->get();

//        dd(auth()->id());
        return view('studentuser.showattendanse',compact('attendanse_data'));
    }

    public function checknotice(Request $request)
    {

        $custemNotification = DB::table('notifications')
            ->Where('notifiable_id' ,auth()->id())
            ->where('type','App\Notifications\CustemNotification')
            ->get();


        // $notice = [];

        //   foreach ($custemNotification as $key => $custem_value) {

        //        $notice [] = json_decode($custem_value->data);

        //   }



        //   dd($notice);

        return view('studentuser.checknotice',compact('custemNotification'));
    }

    public function attendance(Request $request)
    {

        // dd($request->all());

        $data =[];

        $validate = Validator::make($request->all(),[
          'timediff' => 'required',
      ]);

         if ($validate->fails()) {
          $message = "";
          foreach ($validate->errors()->all() as $key => $error_value) {
               $message .= $error_value. '|';
          }

           return response()->json([
                'status' => false,
                'message' => $message,
                'data' => $data,
            ]);
       }
        $student = Student::with('installments')->where('user_id',auth()->id())->get();

        $student_data = Student::with('installments')->where('user_id',auth()->id())->first();


        foreach ($student as $key => $value) {
            $data =  $value->student_batch;
        }

        // dd($data);

        $data_id = [];
        foreach ($data as $key => $value) {
            $data_id[] =  $value->batch_id;
        }

        $time_data = Itiming::whereIn('id',$data_id)->get();

        $current_time = date(" h:m ");



        // $start_time = [];
        foreach ($time_data as $key => $value) {


            $exlpode_time = explode(":" , $value->start_time);

            $end_time = $exlpode_time[0] += 1;

            $exlpode_current_time = explode(":" , $current_time);

            $currentTime = $exlpode_current_time[0] += 1;

             // dd($currentTime);

            $batch_time = Itiming::whereBetween('start_time' ,[$current_time, $currentTime] )
                ->where('institute_id',$student_data->institute_id)
                ->first();

            // $end_time++;

             // dd($batch_time->id);


            $time = Student_batch::where('student_id',$student_data->id)
                ->where('batch_id',$batch_time->id)->first();

              // dd($time);

        }

        // dd($batch_time->id);

        $start_date = '20'.date('y').'-'.date('m').'-'.date('d').' 00:00:00';

        $end_date = '20'.date('y').'-'.date('m').'-'.date('d').' 23:59:00';

         // dd($end_date);

        $attendance_data = Attendance::where(['student_id' => auth()->user()->student->id, 'batch_id' => $time->batch_id])->whereBetween('created_at',[$start_date, $end_date])->get();

      // dd(count($attendance_data));

        // for ($i=0; $i <= count($attendance_data)  ; $i++) {

            if($request->timediff == 2){

        if (count($attendance_data) == 0) {
             // dd($attendance_data);
            auth()->user()->student->attendance()->create([
                'batch_id' => $time->batch_id,
                'd' => date('d'),
                'attendance' => "P",
            ]);
        }

    }

        $student_time = StudentSession::where(['student_id' => auth()->user()->student->id,
        'batch_id' => $time->batch_id])
         ->whereBetween('date',[$start_date, $end_date])
        ->get();



        if (count($student_time) == 0) {

        $student_time = StudentSession::create([
            'student_id' => $student_data->id,
            'batch_id' => $time->batch_id,
            'date' => date('y-m-d'),
            'in_time' => date("h:i:sa"),
            'out_time' => date("h:i:sa"),
        ]);

     }

     $outtime = StudentSession::where(['student_id' => auth()->user()->student->id,
     'batch_id' => $time->batch_id])
      ->whereBetween('date',[$start_date, $end_date])
     ->first();

// /
    //  dd($hourdiff);


     if($outtime != null){

         $update =$outtime->fill([
             'out_time' => date("h:i:sa"),
         ])->update();

        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );

    }

    public function student_session(Request $request){



    //    dd(date('h:m'));

       $student = Student::with('installments')->where('user_id',auth()->id())->get();


       $student_data = Student::with('installments')->where('user_id',auth()->id())->first();

       foreach ($student as $key => $value) {
           $data =  $value->student_batch;
       }

       // dd($data);

       $data_id = [];
       foreach ($data as $key => $value) {
           $data_id[] =  $value->batch_id;
       }

       $time_data = Itiming::whereIn('id',$data_id)->get();

       $current_time = date(" h:m ");

       foreach ($time_data as $key => $value) {


        $exlpode_time = explode(":" , $value->start_time);

        $end_time = $exlpode_time[0] += 1;

        $exlpode_current_time = explode(":" , $current_time);

        $currentTime = $exlpode_current_time[0] += 1;

        $batch_time = Itiming::whereBetween('start_time' ,[$current_time, $currentTime] )
            ->where('institute_id',$student_data->institute_id)
            ->first();

        $time = Student_batch::where('student_id',$student_data->id)
            ->where('batch_id',$batch_time->id)->first();

        //   dd($time);

    }

       $start_date = '20'.date('y').'-'.date('m').'-'.date('d');

       $end_date = '20'.date('y').'-'.date('m').'-'.date('d');

    //    dd($start_date);

       $student_time = StudentSession::where(['student_id' => auth()->user()->student->id,
       'batch_id' => $time->batch_id])
        ->whereBetween('date',[$start_date, $end_date])
       ->get();



       if (count($student_time) == 0) {

       $student_time = StudentSession::create([
           'student_id' => $student_data->id,
           'batch_id' => $time->batch_id,
           'date' => date('y-m-d'),
           'in_time' => date("h:i:sa"),
           'out_time' => date("h:i:sa"),
       ]);

    }

    $outtime = StudentSession::where(['student_id' => auth()->user()->student->id,
    'batch_id' => $time->batch_id])
     ->whereBetween('date',[$start_date, $end_date])
    ->first();


    if($outtime != null){

        $update =$outtime->fill([
            'out_time' => date("h:i:sa"),
        ])->update();

        // dd(now());


        return response()->json([
            'status' => true,
            'message' => "outtome updated successfully",
            'data' => $update,
        ]);

    }



    // $outtime->update(['out_time' => date('h:m')]);

       return response()->json([
        'status' => true,
        'message' => "Data inserted successfully",
        'data' => $student_time,
    ]);

    }


}
