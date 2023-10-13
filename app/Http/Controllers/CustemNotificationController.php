<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Institute;
use Illuminate\Support\Facades\DB;
use App\Notifications\CustemNotification;


class CustemNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $custemNotification = DB::table('notifications')
        // ->get();


        $institute = Institute::all();

         $id = [];

       foreach ($institute as $key => $value) {

             $id  [] = $value->user_id;
        }

         $userData = User::where('userType',1)->first();

        $adminNotification = DB::table('notifications')
            ->where('type','App\Notifications\CustemNotification')
            ->whereIn('notifiable_id',$id)
            ->get();
//dd($adminNotification);

        foreach ($adminNotification as $key => $custem_value) {

            $type_str = str_replace('\\',' ',$custem_value->type);

            $type = explode(' ', $type_str);

            $custem_value->type = $type[2];
            //dd($custem_value);

            $data = json_decode($custem_value->data);

            $custem_value->data = $data->message;

            $custem_value->subject = $data->subject;

            $custem_value->name = $data->name;

            $custem_value->sender = $userData->name;
        }

        // dd($adminNotification);


         $student = Student::with('user')->Where("institute_id", auth()->id())->get();
          // dd($student);

         $student_id = [];

       foreach ($student as $key => $value) {

             $student_id  [] = $value->user_id;
        }

        $instructor = Instructor::with('user')->where('institute_id',auth()->id())->get();

         $instructor_id = [];

       foreach ($instructor as $key => $value) {

             $instructor_id  [] = $value->user_id;
        }

        $InstituteNotification = DB::table('notifications')
        ->where('type','App\Notifications\CustemNotification')
        ->whereIn('notifiable_id',$student_id)
        ->OrwhereIn('notifiable_id',$instructor_id)
        ->get();

//       dd($InstituteNotification);

        foreach ($InstituteNotification as $key => $custem_value) {

            $type_str = str_replace('\\',' ',$custem_value->type);

            $type = explode(' ', $type_str);

            $custem_value->type = $type[2];
            //dd($custem_value);

            $data = json_decode($custem_value->data);

            $custem_value->data = $data->message;

            $custem_value->subject = $data->subject;

            $custem_value->name = $data->name;

            $custem_value->userType = $data->userType;
        }

       // dd($data->userType);

        // $userData = User::where('id','!=',1)->where('name',$data->name)->get();

        $userData = User::where('userType',2)->get();




        if (auth()->user()->userType == 3) {

            $auth_id = auth()->user()->instructor->institute_id;
        }
        else{

            $auth_id = auth()->id();
        }


        $student_data = Student::with('user')->where('institute_id',$auth_id)->get();

        // dd($student_data);

        $instructorData = Instructor::with('user')->where('institute_id',$auth_id)->get();

        // $instructorData = User::where('userType',4)->get();



        $student =[];

        foreach ($student_data as $key => $value) {

             $student [] = $value->user_id;
        }

        // dd($institute);

        $instructor = [];

        foreach ($instructorData as $key => $value) {

             $instructor [] = $value->user_id;
        }

         $instituteData = User::whereIn('id',$student)->OrwhereIn('id',$instructor)->get();

         $studentData =User::whereIn('id',$student)->get();


         $InstructorNotification = DB::table('notifications')
             ->where('type','App\Notifications\CustemNotification')
             ->whereIn('notifiable_id',$student)
             ->get();

        foreach ($InstructorNotification as $key => $custem_value) {

            $type_str = str_replace('\\',' ',$custem_value->type);

            $type = explode(' ', $type_str);

            $custem_value->type = $type[2];
            //dd($custem_value);

            $data = json_decode($custem_value->data);

            $custem_value->data = $data->message;

            $custem_value->subject = $data->subject;

            $custem_value->name = $data->name;
        }

         // dd($InstructorNotification);


        return view('InstituteNotification.index',compact('userData','instituteData','instructorData','InstituteNotification','adminNotification','studentData','InstructorNotification'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();

        // dd($request->all());

        $message = $request->message;

        $subject = $request->subject;

        $sender = $request->sender;

        $user_id = $request->user_id;

        $tdate = $request->tdate;

        $fdate = $request->fdate;


        $user_id = explode(",", $user_id);

        foreach ($user_id as $key => $user_value) {
            $userData = User::find($user_value);

            if ($userData != null) {

            $userData->message = $message;
            $userData->subject = $subject;
            $userData->tdate = $tdate;
            $userData->fdate = $fdate;
            $userData->sender = auth()->user()->name;
            $userData->notify(new CustemNotification($userData));
            }
             // dd($userData);
        }

        return response()->json([
            'status'=>true,
            'message'=>"Email Send Successfaully.",
            'data'=>$data
        ]);
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

         $notification = DB::table('notifications')->where('id',$id)->first();
    }
}
