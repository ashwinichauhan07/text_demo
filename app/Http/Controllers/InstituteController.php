<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use App\Notifications\RegisterNotify;
use Intervention\Image\Facades\Image;
use App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Course;
use DB;



class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $instituteData = User::where('userType',2)->get();

         $record = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->where('userType',2)
        ->groupBy('day_name','day')
        ->orderBy('day','desc')
        ->get();
        //dd($record);

        $data = [];
        foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
        }

        $data_count = 0;

        if (isset($data['data']) && !empty($data['data'])) {

            foreach ($data['data'] as $key => $data_value) {
            $data_count += $data_value;
            }

            $data['count'] = $data_count;

        }

       // data for pie char

        $data['total'] = ['institute','student'];

        $institute = User::where(['userType' => 2])->count();

        $student = User::where(['userType' => 4])->count();

        $data['total_count'] = [$institute,$student];


        $data['chart_data'] = json_encode($data);

        $instituteData = Institute::with('user')->get();
        return view('institute.index',compact('instituteData'),$data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $courseData = Course::all();
         return view('institute.create',compact('courseData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $userData = request()->validate([
            'userType'       =>'required',
            'name'          =>'required',
            'email'         =>'required|email|unique:users',
            'principle_name'=>'required',
            'principle_mob' =>'required|unique:institutes|max:10|min:10',
            'principle_email'=>'required|email|unique:institutes',
            'address'       => 'required',
            'course_id'   => 'required',
            'start_time'    => 'required',
            'end_time'    => 'required',
             'pc'    => 'required',
            'institute_code'=> 'required',
             'inst_logo'        => '',
            'password'      => 'required|confirmed|min:6',
        ]);

         $course_Data = "";
         $course_Data = $request->course_id;
         $course = Course::WhereIn('id', $course_Data)->get();
         $course_arr = [];

        foreach ($course as $key => $course_value) {

             $course_arr[] = $course_value->id;
        }

        $course_Data = implode(" , ", $course_arr);


        $userData = new User;
        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->password = Hash::make($request->password);
        $userData->userType = $request->userType;
        $userData->email_verified_at = now();
        $userData->save();
        $userData->institute()->create([
            'name' => $request->name,
            'email' => $request->email,
            'principle_name' => $request->principle_name,
            'principle_mob' => $request->principle_mob,
            'student_mob' => $request->student_mob,
            'principle_email' => $request->principle_email,
            'gender' => $request->gender,
            'handicap_id' => $request->handicap_id,
            'address' => $request->address,
            'course_id' => $request->course_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'pc' => $request->pc,
            'institute_code' => $request->institute_code,
            'course_id' => $course_Data,
            'password' => $request->password,
            'inst_logo' => "",
        ]);

        if($request->inst_logo != null)
        {
//        dd('ll');

            $image = $request->file('inst_logo');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('adminlogo'),$imageName);

//dd($imageName);
            $userData->institute()->update([
                'inst_logo' => $imageName,
            ]);
        }

        foreach ($course_arr as $key => $course_value) {

//            dd($course_arr);
            $userData->institute->institutecourse()->create([
            'course_id' => $course_value
        ]);
        }


       // foreach ($course_arr as $key => $course_value) {

       //       $course = $course_value;
       //  }

       // dd($course_value);


       // $data  = $course_Data;

       //  dd($data);

        $userData->notify(new RegisterNotify($userData));

        return redirect()->route('institute.index')->with('status','Institute Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function show(Institute $institute)
    {

         $course =  explode(',', $institute->course_id);

         $courseData = Course::WhereIn('id', $course)->get();

        return view('institute.show',compact('institute','courseData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function edit(Institute $institute)
    {
          $courseData = Course::all();
        return view('institute.edit',compact('institute','courseData'));
    }


    public function notice(Request $request)
    {


        $custemNotification = DB::table('notifications')
         ->find($request->id);

                //  dd($request->all());


          $Notification = DB::table('notifications')->where('id',$request->id)->update([
           'read_at' => now()
        ]);


        //    dd($Notification);

            $data = json_decode($custemNotification->data);

            $custemNotification->data = $data->message;

            $custemNotification->subject = $data->subject;

             $custemNotification->name = $data->name;


            // dd($custemNotification->read_at);


        return view('instituteadmin.notice',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institute $institute)
    {
         $validatedData = $request->validate([
            'name'          =>'required',

            // 'email'         =>['required',Rule::unique('users')->ignore($institute->user->email,'email'),],

            'principle_name'=>'required',
//
            // 'principle_mob' =>['required','max:10','min:10',Rule::unique('institutes')->ignore($institute->principle_mob,'principle_mob'),],

            // 'principle_email'=>['required',Rule::unique('institutes')->ignore($institute->principle_email,'principle_email'),],

            'address'       => 'required',
            'course_id'   => 'required',
            'start_time'    => 'required',
            'end_time'    => 'required',
             'pc'    => 'required',
            'institute_code'=> 'required',
             'inst_logo' => '',
        ]);

         $course_Data = "";

         $course_Data = $request->course_id;

         $course = Course::WhereIn('id', $course_Data)->get();

        $course_arr = [];

        foreach ($course as $key => $course_value) {

             $course_arr[] = $course_value->id;
        }



        $course_Data = implode(" , ", $course_arr);

        $institute->user->fill([
            'name'      => $request->name,
            // 'email'     => $request->email,
            // 'password'  => Hash::make($request->password),
        ])->update();



        $institute->fill([
            'principle_name' => $request->principle_name,
            // 'principle_mob' => $request->principle_mob,
            // 'principle_email' => $request->principle_email,
            'address' => $request->address,
            'course_id' => $course_Data,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'pc' => $request->pc,
            // 'grno' => $request->grno,

            'institute_code' => $request->institute_code,
            'inst_logo' => $institute->inst_logo,
        ])->update();

        if ($request->inst_logo != null) {

            $image = $request->file('inst_logo');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('adminlogo'),$imageName);

            $institute->fill([
                'inst_logo' => $imageName,
            ])->update();
        }

       $institute->institutecourse()->delete();

        foreach ($course_arr as $key => $course_value) {

            $institute->institutecourse()->create([
            'course_id' => $course_value,

        ])->update();
    }

        return redirect()->route('institute.index')->with('status','Institute Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institute $institute)
    {
         $institute->delete();
        //  $institute->user->delete();

         $institute->institutecourse()->delete();

        return redirect()->route('institute.index')->with('status','Institute Deleted Successfully.');
    }
}
