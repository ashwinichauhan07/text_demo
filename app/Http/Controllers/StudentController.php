<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Handicap;
use App\Models\InstituteCourse;
use App\Models\Document;
use App\Models\Isession;
use App\Models\Institute;
use App\Models\Grnumber;
use App\Models\Itiming;
use App\Models\Student_Repeat;
use App\Models\Coursefee;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student_grno;
use App\Models\Student_studentType;
use App\Models\StudentReappear;
use App\Models\Course;
use App\Models\Student_course;
use App\Models\Subject;
use App\Models\Studentinstallments;
use App\Models\StudentType;
use App\Models\StudentSubject;
use App\Models\Student_batch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use App\Notifications\RegisterNotify;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\HandicapController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use DB;
use PDF;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::where('userType',4)->get();
        $record = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->where('userType',4)
        ->groupBy('day_name','day')
        ->orderBy('day','desc')
        ->get();

        // dd(auth()->user()->instructor->institute_id);

        // $students = User::with('roles','student')->where('userType',4)->get();

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

         $students = Student::with('user')->get();

         if (auth()->user()->userType != 1) {
            $student_id = [];

            foreach ($students as $key => $stu_value) {
                if ($stu_value->institute_id != $auth_id) {
                    unset($students[$key]);
                } else {
                    $student_id[] = $stu_value->user_id;
                }
            }

        $record = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->where('userType',4)
        ->WhereIn('id', $student_id)
        ->groupBy('day_name','day')
        ->orderBy('day','desc')
        ->get();
    }
        $data = [];
        foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
        }
         // dd($data);

        $data_count = 0;
        if (isset($data['data']) && !empty($data['data'])) {
            foreach ($data['data'] as $key => $data_value) {
            $data_count += $data_value;
            }
            $data['count'] = $data_count;
        }

            // $student = Student::
            //      Where("institute_id", auth()->id())
            //     ->pluck('id');


            // $student_subject = StudentSubject::where('institute_id',$auth_id)
            // ->where('old',0)
            // ->whereIn('student_id',$student)
            // ->get();

           $data['chart_data'] = json_encode($data);
           // dd($data);

        return view('students.index',compact('students'),$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

            if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }

             $handicapData = Handicap::all();
             $documentData = Document::all();
             $courseData = Course::all();
             $subjectData = Subject::all();
             $isessions = Isession::all();
             $coursefees =Coursefee::all();
             $institute =Institute::all();

             $itiming_id = Itiming::where('institute_id',$auth_id)->pluck('id');
             $student_id = Student::where('institute_id',$auth_id)->pluck('user_id');

             $batch_count = DB::table('Student_batches')
             ->select(DB::raw('count(*) as batch_count, batch_id'))
             ->where('batch_id', '<>', 0)
             ->groupBy('batch_id')
             ->get();

             if (auth()->user()->userType == 2) {

                $fullbatch = $batch_count->whereIn('batch_count',auth()->user()->institute->pc);

             }
             else{


                $fullbatch = $batch_count->whereIn('batch_count',auth()->user()->instructor->institute->pc);

              }


             $fullbatch_id = $fullbatch->pluck('batch_id');


             $itimings = Itiming::where('institute_id',$auth_id)
             ->whereNotIn('id',$fullbatch_id)
             ->get();


            //  dd($batch_count);
             $studid = Student::where('institute_id',$auth_id)->pluck('id');


// dd($student_batch);
// dd($count);->havingRaw('COUNT(<columneName>) > 1')
            $studentType =StudentType::where('institute_id',$auth_id)->get();

         return view('students.create',compact('handicapData','documentData','courseData','subjectData','isessions','itimings','coursefees','institute','studentType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->itiming_id);
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'student_mob' => 'required|unique:students|max:10|min:10',
            'email' =>'required|email|unique:users',
            'gender' => 'required',
            'handicap_id' => '',
            'address' => 'required',
            'school' => 'required',
            'education' => 'required',
            'document_id' => 'required',
            'identity_number' => 'required',
            'dob' => 'required',
            'doaddmission' => 'required',
            'course_id' => 'required',
            'subject_id' => 'required',
            'student_type' => 'required',
            'itiming_id' => 'required',
            'coursefee_id' => 'required',
            'isession_id' => 'required',
             'year'  => '',
            'student_img'=> '',
            'identity_img'=> '',
            'password' => 'required|confirmed|min:6',
        ]);


    //     $student_batch = [];

    //     foreach ($request->itiming_id as $key => $student_batch_value) {

    //      $student_batch [] =Student_batch::where('batch_id',$student_batch_value)->first();


    //    }

    //    count(array($variable));


    //    dd(count(array($student_batch)));


        $students = Student::with('user')->get();

        $subject_Data = "";

        $subjec_Data = $request->subject_id;

        // $subject = Subject::WhereIn('id', $subjec_Data)->get();

        // dd($subjec_Data);
        // $subject_arr = [];

        // foreach ($subject as $key => $subject_value) {

        //      $subject_arr[] = $subject_value->subject->name;
        // }

        $subjectData ="";

        $subjectData = implode(" , ", $subjec_Data);

        // dd($subjectData);

        $timingData ="";

        $timingData = $request->itiming_id;

        $timing_Data = implode(",", $request->itiming_id);

        // dd($timingData);

        $coursefeeData ="";

        $coursefeeData = $request->coursefee_id;
        // dd($coursefeeData);

        $coursefee = Coursefee::WhereIn('id', $coursefeeData)->get();

        $fees = 0;
        $fees_arr = [];

        foreach ($coursefeeData as $key => $coursefee_value) {
             $fees_arr[] = $coursefee_value;
             $fees += $coursefee_value;
        }
        // dd($fees);

         $feesData ="";

        $feesData = implode(" , ", $coursefeeData);

        // dd($feesData);

        $courseData = "";

        $courseData = $request->course_id;

        // $course = InstituteCourse::WhereIn('id', $course_Data)->get();

        // $course_arr = [];

        // foreach ($course as $key => $course_value) {

        //      $course_arr[] = $course_value->course->name;
        // }
        $course_Data = implode(" , ", $courseData);

         // dd($courseData);
        //insert data into user
        $userData = new User;
        $userData->name = $request->firstname;
        $userData->email = $request->email;
        $userData->password = Hash::make($request->password);
        $userData->show_password = $request->password;
        $userData->email_verified_at = now();
        $userData->save();

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $userData->student()->create([
            'institute_id' => $auth_id,
            'created_id'  => auth()->id(),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'student_mob' => $request->student_mob,
            'email' => $request->email,
            'gender' => $request->gender,
            'handicap_id' => $request->handicap_id,
            'address' => $request->address,
            'school' => $request->school,
            'education' => $request->education,
            'document_id' => $request->document_id,
            'otherdocument' => $request->otherdocument,
            'identity_number' => $request->identity_number,
            'dob' => $request->dob,
            'doaddmission' => $request->doaddmission,
            'course_id' => $course_Data,
            'subject_id' => $subjectData,
            'student_type' => $request->student_type,
             'itiming_id' => $timing_Data,
             'coursefee_id'  => $feesData,
            'isession_id' => $request->isession_id,
             'year' => $request->year,
            'student_img' => "",
            'identity_img' => "",
        ]);

        if($request->student_img != null)
        {
             $image = $request->file('student_img');
             $imageName = time().'.'.$image->extension();
             $image->move(public_path('images'),$imageName);
                $userData->student->fill([
                    'student_img' => $imageName,
                ])->update();
        }
        if($request->identity_img != null)
        {
            // dd('ll');
            $image1 = $request->file('identity_img');
            $identityimage = time().'.'.$image1->extension();
            $image1->move(public_path('identitimages'),$identityimage);
             $userData->student->fill([
                    'identity_img' => $imageName,
                ])->update();
        }
        $userData->student->installments()->create([
            'institute_id' => $auth_id,
            'created_id'  => auth()->id(),
            'amount'     => $fees,
            'mode'       => 1,
            'type'       => 2,
        ]);

        $userData->student->student_studentType()->create([
            'institute_id' => $auth_id,
            'studenttype_id' =>$request->student_type
        ]);

         foreach ($courseData as $key => $course_value) {
            $userData->student->student_course()->create([
            'course_id' => $course_value,
            'student_type' =>$request->student_type,
            'doaddmission'=> $request->doaddmission,
            'isession_id'=> $request->isession_id,
            'year'=> $request->year,
        ]);
        }

         foreach ($timingData as $key => $timing_value) {
            $userData->student->student_batch()->create([
            'batch_id' => $timing_value,
            'student_type' =>$request->student_type
        ]);
        }

        $grnoData =Grnumber::where('institute_id',$auth_id)->first();

        $studentData = Student::with('institute')->Where('institute_id',$auth_id)->get();

         if ($studentData->count() == 1) {

        $subject_gr = $grnoData->grnumber;

            foreach ($subjec_Data as $key => $subject_value) {

            $userData->student->student_subject()->create([
            'institute_id' => $auth_id,
            'subject_id' => $subject_value,
            'student_type' =>$request->student_type,
            'subject_grno'=> $subject_gr++,
            'doaddmission'=> $request->doaddmission,
            'isession_id'=> $request->isession_id,
            'year'=> $request->year,
        ]);
        }
      }
        else{
             $grnoData =  DB::table('student_subjects')->latest('subject_grno')
             ->where('institute_id',$auth_id)
             ->first();

             $student_grno = $grnoData->subject_grno;
               // $grno = $student_grno +1;
             foreach ($subjec_Data as $key => $subject_value) {
             $userData->student->student_subject()->create([
                'institute_id' => $auth_id,
                'subject_id' => $subject_value,
                'student_type' =>$request->student_type,
                'subject_grno'=> ++$student_grno,
                'doaddmission'=> $request->doaddmission,
                'isession_id'=> $request->isession_id,
                'year'=> $request->year,
         ]);

         }
      }

        $studentData = Student::with('institute')->Where('institute_id',$auth_id)->get();

        // $student_Data = Student::with('student_subject')->Where('institute_id',auth()->id())->get();

        if ($studentData->count() == 1) {
             $student_gr = $grnoData->grnumber;
             $userData->student->student_grno()->create([
            'institute_id' => $auth_id,
            'student_grno' => $student_gr,
            'student_type' =>$request->student_type,
            'doaddmission'=> $request->doaddmission,
            'isession_id'=> $request->isession_id,
            'year'=> $request->year,
        ]);
        }
        else {
            $grnoData = DB::table('student_grnos')->latest('student_grno')
                ->where('institute_id', $auth_id)->first();
            $student_grno = $grnoData->student_grno;
            $grno = $student_grno + 1;
            $userData->student->student_grno()->create([
                'institute_id' => $auth_id,
                'student_grno' => $grno,
                'student_type' => $request->student_type,
                'doaddmission' => $request->doaddmission,
                'isession_id' => $request->isession_id,
                'year' => $request->year,
            ]);
        }
        $userData->notify(new RegisterNotify($userData));
        return redirect()->route('students.index')->with('status','Student Created Successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

          $itiming = explode(',', $student->itiming_id);

         // dd($itiming);

         // dd($student->itiming_id);

         // $itiming = explode(',', $itiming[0]);

         $itimingData = Itiming::WhereIn('id', $itiming)->get();

             if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }
          $student_Data = Student::with('student_subject')->Where('institute_id',auth()->id())->get();

            $student_subject = StudentSubject::where('institute_id',$auth_id)
            ->where('old',0)
            ->where('student_id',$student->id)
            ->get();

             $student_course = Student_course::where('old',0)
            ->where('student_id',$student->id)
            ->get();

             return view('students.show',compact('student','itimingData','student_subject','student_course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
//dd($student;
          $handicapData = Handicap::all();

          $documentData = Document::all();

          $subjectData = Subject::all();

          $isessions = Isession::all();


          if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
           echo"<h1>Hello</h1>";
          }
          else{

            $auth_id = auth()->user()->instructor->institute_id;
          }

          $itimings = Itiming::where('institute_id',$auth_id)->get();

          $courseData = Course::all();

          // $courseData = InstituteCourse::where('institute_id',$auth_id)->get();

          // dd($courseData);

          $student_batch =Student_batch::where('student_id',$student->id)->get();

          $coursefees =Coursefee::all();

          $itiming = explode(',', $student->itiming_id);

         // $itiming = explode(']', $itiming[1]);

         // $itiming = explode(',', $itiming[0]);

          $itimingData = Itiming::WhereIn('id', $itiming)->get();


            $student_subject = StudentSubject::where('institute_id',$auth_id)
            ->where('old',0)
            ->where('student_id',$student->id)
            ->get();

             $student_course = Student_course::where('old',0)
            ->where('student_id',$student->id)
            ->get();

             $studentType =StudentType::where('institute_id',$auth_id)->get();

            //  dd($student->coursefee_id);

        return view('students.edit',compact('student','handicapData','documentData','courseData','subjectData','isessions','itimings','coursefees','itimingData','student_subject','student_course','studentType','student_batch'));
    }


      public function createPDF(Student $student) {

      $name = $student->user->name;

      $email = $student->user->email;

       $user =Institute::all();

                $institute = [];

              foreach ($user as $key => $user_value) {
                  $institute[] =$user_value->address;
              }

        if (auth()->user()->userType !=1) {
            $inst_id = [];
              foreach ($user as $key => $user_value) {
                  if ($user_value->user_id != auth()->id()) {
                    unset($institute[$key]);
                       }
            }
         }

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        // $course =  explode(',', $student->course_id);

        // $courseData = Course::Where('id', $student->course_id)->get();

        //  $course_arr =[];
        // foreach ($courseData as $key => $course_value) {

        //    $course_arr[] = $course_value->name;;
        // }

        // $course_id = implode(' , ', $course_arr);

        //  dd($courseData);

       $institute_logo = Institute::where('user_id',$auth_id)->first();

        // dd($institute_logo->inst_logo);
       $inst_logo = $institute_logo->inst_logo;

       $address = implode(",", $institute);

       $student['name'] = $name;

       $student['email'] = $email;

       $student['add'] =  $address;

      $student['inst_logo'] =  $inst_logo;

      // $student['course'] =  $course_id;

     // dd($student->student_course as $key => $course_value)

     // $course_arr =[];

     // foreach ($student->student_course as $key => $course_value) {
     //   $course_arr [] = $course_value->course->name;
     // }

     // dd($course_arr);

     $data = [

            'data' => $student,
        ];

      $pdf = PDF::loadView('pdf.form', $data);

      // download PDF file with download method
      return $pdf->stream('form.pdf');

    }

    public function grnumber(Request $request)
    {
        $isessions = Isession::all();
        // $students  = Student::all();

        $session = Isession::where('id',$request->isession_id)->first();

        $choose_session = "";
        $grtype = "";

        if($session != null){
            $choose_session = $session->month->month_name ." to ". $session->monthname->month_name;
        }

        if($request->student == "student_gr"){
            $grtype = "( STUDENTWISE )";
        }
        elseif($request->subject == "subject_gr"){

            $grtype = "( SUBJECTTWISE )";
        }

        $studentData = [];
        $subject_gr =[];

        $subjectgr_Data =[];

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
         }
         else{

             $auth_id = auth()->user()->instructor->institute_id;
         }
// dd($request->all());

        if (isset($request->isession_id) && !empty($request->isession_id) && isset($request->year) && !empty($request->year)) {

            $grData = Student_grno::where('institute_id', $auth_id)->get();

            $grno =[];

            foreach ($grData as $key => $gr_value) {
                 $grno [] = $gr_value->student_id;
            }

            if($request->student == "student_gr"){
                # code...
             $studentData  = Student::with('student_grno')
            ->where(['isession_id'=>$request->isession_id,'year'=>$request->year])
            ->where('institute_id', $auth_id)
            ->WhereIn('id' ,$grno)
            ->get();
            // dd($studentData);
        }

        elseif($request->subject == "subject_gr"){

              $subjectgr_Data = StudentSubject::where('institute_id', $auth_id)->where(['isession_id'=>$request->isession_id,'year'=>$request->year])
              ->get();

            // dd($subjectgr_Data);
            $studen = Student::where(['user_id' => $request->id])->get();

            $grno =[];

            foreach ($subjectgr_Data as $key => $gr_value) {
                 $grno [$gr_value->student_id] = $gr_value->student_id;
            }

            // dd($grno);
                # code...
            $subject_gr  = Student::with('student_subject')
            ->where(['isession_id'=>$request->isession_id,'year'=>$request->year])
            ->where('institute_id', $auth_id)
            ->WhereIn('id' ,$grno)
            ->get();
            // dd($subject_gr);
        }
    }
         return view('students.grnumber',compact('isessions','studentData','subject_gr','subjectgr_Data','choose_session','grtype'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
    //    dd($request->name);
        $validatedData = $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            // 'student_mob' => ['required','max:10','min:10',Rule::unique('students')->ignore($student->student_mob,'student_mob'),],
            
            // 'email' =>['required',Rule::unique('users')->ignore($student->user->email,'email'),],
            'gender' => 'required',
            'handicap_id' => '',
            'address' => 'required',
            'school' => 'required',
            'education' => 'required',
            'document_id' => 'required',
            'identity_number' => 'required',
            'dob' => 'required',
            'doaddmission' => 'required',
            // 'course_id' => 'required',
            // 'subject_id' => 'required',
            // 'student_type' => 'required',
             'itiming_id'  => 'required',
            // 'coursefee_id' => 'required',
             'isession_id' => 'required',
            'year'  => '',
            'student_img'=> '',
            'identity_img'=> '',
            'password' => 'required|confirmed|min:6',

        ]);

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
         }
         else{

             $auth_id = auth()->user()->instructor->institute_id;
         }


        $fullname = $request->name . '' . $request->lastname;

        $student->user->fill([
            'name'   => $request->name,
          // 'email'     => $student->user->email,
          'password'  => Hash::make($request->password),
          'show_password'  => $request->password,
      ])->update();

//       $student->user->fill([
//         'name'   => $request->name,

//   ])->update();
            $timingData ="";

            $timingData = $request->itiming_id;
            //        dd($timingData);
            $timing_Data = implode(",", $request->itiming_id);

        $student->fill([
            // 'institute_id' => auth()->id(),
            'lastname' => $request->lastname,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'gender' => $request->gender,
            'handicap_id' => $request->handicap_id,
            'school' => $request->school,
            'education' => $request->education,
            'document_id' => $request->document_id,
            'otherdocument'  => $request->otherdocument,
            'identity_number' => $request->identity_number,
            'dob' => $request->dob,
            'doaddmission' => $request->doaddmission,
            'address' => $request->address,
            // 'course_id' => $course_Data,
            // 'subject_id' => $subjec_Data,
            'student_type' => $request->student_type,
            'itiming_id' => $timing_Data,
            // 'coursefee_id'  => $feesData,
             'isession_id' => $request->isession_id,
            'year' => $request->year,
            'student_img' => $student->student_img,
            'identity_img' => $student->identity_img,
        ])->update();


        // dd($request->name);

            if ($request->student_img != null) {

                $image = $request->file('student_img');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('images'),$imageName);

                 $student->fill([
                    'student_img' => $imageName,
                ])->update();
                    }

             if ($request->identity_img != null) {

                $image1 = $request->file('identity_img');
                $identityimage = time().'.'.$image1->extension();
                $image1->move(public_path('identitimages'),$identityimage);

                 $student->fill([
                    'identity_img' => $identityimage,
                ])->update();
                    }
                    

                $course_Data = "";
                 
                $course_Data = $request->course_id;
                



        $subject_Data = "";

        $subjec_Data = $request->subject_id;

        // dd($subjec_Data);

        // $subject = Subject::WhereIn('id', $subjec_Data)->get();

        // dd($subjec_Data);
        // $subject_arr = [];

        // foreach ($subject as $key => $subject_value) {

        //      $subject_arr[] = $subject_value->subject->name;
        // }

        //  $subjectData ="";

        //  $subjectData = implode(" , ", $subjec_Data);

        $coursefeeData ="";

        $coursefeeData = $request->coursefee_id;

        // dd($coursefeeData);

        if($coursefeeData != null){
            $fees = 0;

                foreach ($coursefeeData as $key => $coursefee_value) {
                    $fees += $coursefee_value;
                }

         $feesData ="";

         $feesData = implode(" , ", $coursefeeData);

                $student->update([
                    'coursefee_id' => $feesData,
                ]);

        $insatllment = $student->installments->where('type',2)->first();

        $insatllment->update([
            'amount' => $fees,
        ]);
        }

        // dd($fees);

        // dd($insatllment);

         $student->student_batch()->delete();

         foreach ($timingData as $key => $timing_value) {

            $student->student_batch()->create([
            'batch_id' => $timing_value,
            'student_type' => $request->student_type,
             // $student->student_batch()->update(['batch_id' => $timing_value,]);
            ]);
        }


        foreach ($course_Data as $key => $course_value) {

            if($course_value != "course_id"){

                $student->student_course()->delete();
                // dd(';l');
            $student->student_course()->create([
            'course_id' => $course_value,
            'student_type' => $student->student_type,
            'doaddmission' => $request->doaddmission,
            'isession_id' => $request->isession_id,
            'year' => $request->year,
            'old' => 0
          ]);
        }
    }

        $grnoData =  DB::table('student_subjects')->latest('subject_grno')
             ->where('institute_id',$auth_id)
             ->first();

             $student_grno = $grnoData->subject_grno;
// dd($student_grno);


          if($subjec_Data != null){

            $student->student_subject()->delete();

            foreach ($subjec_Data as $key => $subject_value) {

                $student->student_subject()->create([
                    'institute_id' => $auth_id,
                    'subject_id' => $subject_value,
                    'student_type' => $student->student_type,
                    'subject_grno' => ++$student_grno,
                    'doaddmission' => $request->doaddmission,
                    'isession_id' => $request->isession_id,
                    'year' => $request->year,
                    'old' => 0
                  ]);

            }


          }

        return redirect()->route('students.index')
                        ->with('status','Student Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */


    public function destroy(Student $student)
    {
        $studentinstallment = Studentinstallments::where('student_id',$student->id)
        ->delete();

        // $studentInfo = Studentinstallments::onlyTrashed()->get();

           // dd($studentInfo);
        // $studentinstallment->delete();

         // dd($studentinstallment);

          $student->user->delete();

          $student->delete();

          $student->student_batch()->delete();

          $student->student_course()->delete();

          $student->student_subject()->delete();


        return redirect()->route('students.index')
                    ->with('success','Student Deleted Successfully.');
    }

     public function details(Request $request)
    {

        $data = array();

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
          }
         else{

            $auth_id = auth()->user()->instructor->institute_id;
         }

        // dd($studentReappearData);


        $students = Student::with('user')->Where("institute_id", $auth_id)->get();

        // dd($students)

        $id =[];

        foreach ($students as $key => $Stude_id) {
            $id[] = $Stude_id->user_id;
        }

        $userData = User::with('student')->where('name','LIKE','%'.$request->name.'%')
        ->where(['userType'=>4])
        ->whereIn('id', $id)
        ->get();

        // dd($userData);

        if (!is_null($userData)) {

            foreach($userData as $key => $user_value){


            $user_value->student->course;
            $user_value->student->subject;

            // fees details
    $total = Studentinstallments::where(['student_id' => $user_value->student->id])
                    ->where(['type' => 2])
                    ->get();

    $total_amount = 0;
    foreach ($total as $key => $total_value) {
        $total_amount += $total_value->amount;
    }

                    // dd($total->amount);

    $paid = Studentinstallments::where(['student_id' => $user_value->student->id])
                    ->where(['type' => 1])
                    ->get();

    $paid_amount = 0;
    foreach ($paid as $key => $paid_value) {
        $paid_amount += $paid_value->amount;
    }

    $unpaid = Studentinstallments::where(['student_id' => $user_value->student->id])
                    ->where(['type' => 2])
                    ->get();

    $unpaid_amount = 0;
    foreach ($unpaid as $key => $unpaid_value) {
        $unpaid_amount += $unpaid_value->amount;
    }

    // if (isset($request->student_type) && !empty($request->student_type)) {

            $studentSubject =StudentSubject::Where("institute_id", $auth_id)
            ->where('student_id',$user_value->student->id)
            ->where('old',0)
            ->get();

            $studentCourse =Student_course::where('student_id',$user_value->student->id)
            ->where('old',0)
            ->get();
        // }

         $subject_arr =[];
         foreach ($studentSubject as $key => $studentSubject_value) {

            $subject_arr[] = $studentSubject_value->subject->name;
       }

          $subjectData = implode(',',$subject_arr);

          $course_arr =[];
          foreach ($studentCourse as $key => $studentCourse_value) {

          $course_arr [] = $studentCourse_value->course->name;
        }

          $courseData = implode(',',$course_arr);
       // dd($subjectData);
    $user_value['fess'] =  $total_amount;
    $user_value['paid_fess'] =  $paid_amount;
    $user_value['subject_data'] =  $subjectData;
    $user_value['course_data'] =  $courseData;
    $user_value['unpaid_fess'] =  $unpaid_amount - $paid_amount;
            }

            return response()->json([
                'status'    => true,
                'message'   => 'Student Data',
                'data'      => $userData,
            ]);
        }
    }

    public function searchname(Request $request)
    {

        // dd($request->studentinstallment_id);
        $data = array();

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
          }
         else{

            $auth_id = auth()->user()->instructor->institute_id;
         }



        $students = Student::with('user')->Where("id", $request->student_id)->first();

                // dd($students->user_id);


        // $id =[];

        // foreach ($students as $key => $Stude_id) {
        //     $id[] = $Stude_id->user_id;
        // }

        $userData = User::with('student')->where('name','LIKE','%'.$request->name.'%')
        ->where(['userType'=>4])
        ->where('id', $students->user_id)
        ->first();


        if (!is_null($userData)) {


            $userData->student->course;
            $userData->student->subject;

                    // dd($userData->student->subject);


            // fees details
    $total = Studentinstallments::where(['student_id' => $request->student_id])
                    ->where(['type' => 2])
                    ->get();

    $total_amount = 0;
    foreach ($total as $key => $total_value) {
        $total_amount += $total_value->amount;
    }


    $paid = Studentinstallments::where(['student_id' => $request->student_id])
                    ->where(['type' => 1])
                    ->where('id', '<=', $request->studentinstallment_id)
                    ->get();

    $paid_amount = 0;
    foreach ($paid as $key => $paid_value) {
        $paid_amount += $paid_value->amount;
    }

    $unpaid = Studentinstallments::where(['student_id' => $request->student_id])
                    ->where(['type' => 2])
                    ->get();

    $unpaid_amount = 0;
    foreach ($unpaid as $key => $unpaid_value) {
        $unpaid_amount += $unpaid_value->amount;
    }

    // dd($unpaid);


    // if (isset($request->student_type) && !empty($request->student_type)) {

            $studentSubject =StudentSubject::Where("institute_id", $auth_id)
            ->where('student_id',$userData->student->id)
            ->where('old',0)
            ->get();

            $studentCourse =Student_course::where('student_id',$userData->student->id)
            ->where('old',0)
            ->get();
        // }

         $subject_arr =[];
         foreach ($studentSubject as $key => $studentSubject_value) {

            $subject_arr[] = $studentSubject_value->subject->name;
       }

          $subjectData = implode(',',$subject_arr);

          $course_arr =[];
          foreach ($studentCourse as $key => $studentCourse_value) {

          $course_arr [] = $studentCourse_value->course->name;
        }

          $courseData = implode(',',$course_arr);

          $studentinstallmentsData = Studentinstallments::find($request->studentinstallment_id);

          if($studentinstallmentsData->next_installmentdate != null){
            $next_installmentdate = date("Y-m-d", strtotime($studentinstallmentsData->next_installmentdate));
          }
          else{

            $next_installmentdate = null;
          }

          $payemnt_mode = $studentinstallmentsData->mode;

    //    dd($studentinstallmentsData);
    $userData['fess'] =  $total_amount;
    $userData['paid_fess'] =  $paid_amount;
    $userData['subject_data'] =  $subjectData;
    $userData['course_data'] =  $courseData;
    $userData['unpaid_fess'] =  $unpaid_amount - $paid_amount;
    $userData['next_installmentdate'] =  $next_installmentdate;
    $userData['payemnt_mode'] =  $payemnt_mode;
    $userData['studentinstallmentsData'] =  $studentinstallmentsData;
            }

            return response()->json([
                'status'    => true,
                'message'   => 'Student Data',
                'data'      => $userData,
            ]);
        }


    public function coursefilter(Request $request){

      $data =[];

      // dd('jhhuuyhjj');
      $validate = Validator::make($request->all(),[
          'student_type' => 'required',
      ]);

      // dd($validate->validated()['student_type']);
      // dd($validate->fails());

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

       if (auth()->user()->userType == 2) {
           $auth_id = auth()->id();
        }
        else{
            $auth_id = auth()->user()->instructor->institute_id;
        }

          $course = Coursefee::with('course')
         ->where('student_type',$validate->validated()['student_type'])
         ->Where("institute_id", $auth_id)
         ->get();

          $courseData = $course->unique('course_id');

          $courseData->values()->all();

        return response()->json([
                'status' => true,
                'message' => "courseData list",
                'data' => $courseData,
            ]);
      }

      public function subjectfilter(Request $request){

        // dd($request->course);
        $data =[];

        $validate = Validator::make($request->all(),[
          'course' => 'required',
          'student_type' => 'required',
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

         $course_ex = explode(',', $validate->validated()['course']);

         if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
         }
         else{

            $auth_id = auth()->user()->instructor->institute_id;
         }

         // dd($validate->validated()['course']);
          $subject = Coursefee::with('subject')
         ->whereIn('course_id',$course_ex)
         ->Where("institute_id", $auth_id)
         ->Where("student_type", $validate->validated()['student_type'])
         ->get();

         $subjectData = $subject->unique('subject_id');

         $subjectData->values()->all();


        //  $subjectData['incorrect_ans'] = ["ans1","an2","an3"];


        return response()->json([
                'status' => true,
                'message' => "Subject Data",
                'data' => $subjectData,
            ]);
      }

      public function feesfilter(Request $request){

       $data =[];

        $validate = Validator::make($request->all(),[
          'subject' => 'required',
          'student_type' => 'required',
          // 'course_data' => 'required',

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

       $fees_ex = explode(',', $validate->validated()['subject']);

         if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
          }
         else{

            $auth_id = auth()->user()->instructor->institute_id;
         }

          $feesData = Coursefee::whereIn('subject_id',$fees_ex)
          ->where('student_type',$validate->validated()['student_type'])
          // ->where('course_data',$validate->validated()['course_data'])
          ->Where("institute_id", $auth_id)
          ->get();

        return response()->json([
                'status' => true,
                'message' => "feesData list",
                'data' => $feesData,
            ]);

      }

      public function search(Request $request){

        // dd($request);

         $data = [];

          if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
          }
         else{

            $auth_id = auth()->user()->instructor->institute_id;
         }

        $students = Student::with('user')->Where("institute_id", $auth_id)->get();

        $id =[];

        foreach ($students as $key => $Stude_id) {
            $id[] = $Stude_id->user_id;
        }

        $userData = User::with('student')->where(['name'=>$request->name])
        ->where(['userType'=>4])
        ->whereIn('id', $id)
        ->first();


         $subjectData = explode(',', $userData->student->subject_id);

         $subject_data =Subject::whereIn('id',$subjectData)->get();

         $userData['subject_data'] =  $subject_data;

         return response()->json([
                'status'    => true,
                'message'   => 'Student Data',
                'data'      => $userData,
            ]);

      }

        public function repeat_index(){

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
          }
         else{

            $auth_id = auth()->user()->instructor->institute_id;
         }

          $student_repeat = Student_Repeat::where('institute_id',$auth_id)
          ->get();

         return view('students.repeat_index',compact('student_repeat'));

        }

        public function repeat(Student $student_repeat){

          $courseData = Course::all();
          $subjectData = Subject::all();
          $isessions = Isession::all();
          $itimings = Itiming::all();
          $coursefees =Coursefee::all();
          $itiming = explode(',', $student_repeat->itiming_id);

            if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }

             $student_subjectData = StudentSubject::where('institute_id',$auth_id)
             ->where('old',0)
             ->where('student_id',$student_repeat->id)
             ->get();

             $student_data = Student_course::where('old',0)
             ->where('student_id',$student_repeat->id)
             ->get();

             $student_course = $student_data->unique('course_id');

             $student_subject = $student_subjectData->unique('subject_id');

             $stud_data = Student_Repeat::where('student_id',$student_repeat->id)
             ->latest()
             ->first();

           $studentType =StudentType::where('institute_id',$auth_id)->get();

           $student_Type =Student_studentType::where('institute_id',$auth_id)
           ->where('student_id', $student_repeat->id)
           ->latest()
           ->first();

            $itimingData = Itiming::WhereIn('id', $itiming)->get();

        return view('students.repeat',compact('student_repeat','courseData','subjectData','isessions','itimings','coursefees','itimingData','studentType','student_subject','student_course'));
         }

     public function repeat_update(Request $request, Student $student_repeat) {

        $validatedData = $request->validate([
            'doaddmission' => 'required',
            'student_type' => 'required',
            'course_id' => 'required',
            'subject_id' => 'required',
            'itiming_id' => 'required',
            'coursefee_id' => 'required',
            'isession_id' => 'required',
            'year' => 'required',
       ]);

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $userData = User::where('id',$student_repeat->user_id)->first();

        $course_id = $request->course_id;
        $course_Data = implode(" , ", $course_id);

        $subject_id = $request->subject_id;
        $subject_Data = implode(" , ", $subject_id);

        $itiming_id = $request->itiming_id;
        $itiming_Data = implode(" , ", $itiming_id);

        $coursefee_id = $request->coursefee_id;
        $coursefee_Data = implode(" , ", $coursefee_id);

        $subjec_Data = $request->subject_id;

        $data = $userData->student->student_repeat()->create([
            'institute_id' => $auth_id,
            'doaddmission'  => $request->doaddmission,
            'student_type'  => $request->student_type,
            'course_id' => $course_Data,
            'subject_id' => $subject_Data,
            'itiming_id' => $itiming_Data,
            'coursefee_id' => $coursefee_Data,
            'isession_id' => $request->isession_id,
            'year' => $request->year,
        ]);

        $coursefee = Coursefee::WhereIn('id', $coursefee_id)->get();

        $fees = 0;
        $fees_arr = [];

        foreach ($coursefee_id as $key => $coursefee_value) {
             $fees_arr[] = $coursefee_value;
             $fees += $coursefee_value;
        }

         $userData->student->installments()->create([
            'institute_id' => $auth_id,
            'created_id'  => auth()->id(),
            'amount'     => $fees,
            'student_type'=> $request->student_type,
            'mode'       => 1,
            'type'       => 2,
        ]);

         $userData->student->student_studentType()->create([
            'institute_id' => $auth_id,
            'studenttype_id' =>$request->student_type
        ]);

           $stud_data = Student_Repeat::where('student_id',$student_repeat->id)
           ->latest()
           ->first();


         $studentcourse_oldrecord =Student_course::where('student_id',$userData->student->id)
         ->where('student_type',$stud_data->student_type)
         ->get();

           foreach ($studentcourse_oldrecord as $key => $course_value) {

           if ($course_value != null) {
            $course_value->update(['old' => 1]);
        }
           }

     foreach ($course_id as $key => $course_value) {
                $courseData = Student_course::where('course_id',$course_value)
               ->where('student_id',$userData->student->id)
               ->where('student_type',$stud_data->student_type)
               ->latest()
               ->first();

               if ($courseData != null) {
            $courseData->update(['old' => 1]);
        }
        }
          foreach ($course_id as $key => $course_value) {
                   $course = Student_course::where('course_id',$course_value)
                   ->where('student_id',$userData->student->id)
                   ->where('student_type',$student_repeat->student_type)
                   ->latest()
                   ->first();

                    $course->where('student_id',$course->student_id)
                    ->where('student_type',$student_repeat->student_type)
                    ->update(['old' => 1]);

             if ($course != null) {
                $course->create([
                    'student_id'=>$course->student_id,
                    'course_id' => $course->course_id,
                    'student_type' => $request->student_type,
                    'doaddmission'=> $request->doaddmission,
                    'isession_id'=> $request->isession_id,
                    'year'=> $request->year,
                    'old' => 0,
                ]);
              }
          }

         $studentsubject_oldrecord =StudentSubject::where('student_id',$userData->student->id)
         ->where('student_type',$student_repeat->student_type)
         ->get();

           foreach ($studentsubject_oldrecord as $key => $subject_value) {
               if ($subject_value != null) {
            $subject_value->update(['old' => 1]);
        }
           }

         $studentsubject_oldrecord =StudentSubject::where('student_id',$userData->student->id)
         ->where('student_type',$stud_data->student_type)
         ->get();

           foreach ($studentsubject_oldrecord as $key => $subject_value) {
               if ($subject_value != null) {
               $subject_value->update(['old' => 1]);
        }
           }

           foreach ($subjec_Data as $key => $subject_value) {
               $subject = StudentSubject::where('subject_id',$subject_value)
               ->where('institute_id',$auth_id)
               ->where('student_id',$userData->student->id)
               ->latest()
               ->first();

                  $subject->create([
                    'student_id'=>$subject->student_id,
                    "institute_id" =>$subject->institute_id,
                    'subject_grno' => $subject->subject_grno,
                    'subject_id' => $subject->subject_id,
                    'student_type' => $stud_data->student_type,
                    'doaddmission'=> $request->doaddmission,
                    'isession_id'=> $request->isession_id,
                    'year'=> $request->year,
                    'old' => 0,
                ]);
            }

         $student_repeat->student_batch()->delete();

         foreach ($itiming_id as $key => $timing_value) {

            $student_repeat->student_batch()->create([
            'batch_id' => $timing_value,
            'student_type' => $student_repeat->student_type
            ]);
        }

       return redirect()->route('studentreport.index')->with('status','Student Repeat Add Successfully.');
}

       public function reappear(Student $student_reappear){

          $courseData = Course::all();
          $subjectData = Subject::all();
          $isessions = Isession::all();
          $itimings = Itiming::all();
          $coursefees =Coursefee::all();
          $itiming = explode(',', $student_reappear->itiming_id);

            if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }

            $student_subject = StudentSubject::where('institute_id',$auth_id)
            ->where('old',0)
            ->where('student_id',$student_reappear->id)
            ->get();

             $student_course = Student_course::where('old',0)
             ->where('student_id',$student_reappear->id)
             ->get();

          $studentType =StudentType::where('institute_id',$auth_id)->get();

          $itimingData = Itiming::WhereIn('id', $itiming)->get();

           return view('students.reappear',compact('student_reappear','courseData','subjectData','isessions','itimings','coursefees','student_subject','student_course','studentType'));
       }

       public function reappear_update(Request $request, Student $student_reappear) {

                 $validatedData = $request->validate([
                    'doaddmission' => 'required',
                    'student_type' => 'required',
                    // 'course_id' => 'required',
                    // 'subject_id' => 'required',
                    // 'itiming_id' => 'required',
                    'coursefee_id' => 'required',
                    'isession_id' => 'required',
                    'year' => 'required',
               ]);

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $userData = User::where('id',$student_reappear->user_id)->first();

        $course_id = $request->course_id;
        $course_Data = implode(" , ", $course_id);

        $subject_id = $request->subject_id;
        $subject_Data = implode(" , ", $subject_id);

        $itiming_id = $request->itiming_id;
        $itiming_Data = implode(" , ", $itiming_id);

        $coursefee_id = $request->coursefee_id;
        $coursefee_Data = implode(" , ", $coursefee_id);

        $subjec_Data = $request->subject_id;

        $data = $userData->student->student_reappear()->create([
            'institute_id' => $auth_id,
            'doaddmission'  => $request->doaddmission,
            'student_type'  => $request->student_type,
            'coursefee_id' => $coursefee_Data,
            'isession_id' => $request->isession_id,
            'year' => $request->year,
        ]);

        $coursefee = Coursefee::WhereIn('id', $coursefee_id)->get();

        $fees = 0;
        $fees_arr = [];

        foreach ($coursefee_id as $key => $coursefee_value) {
             $fees_arr[] = $coursefee_value;
             $fees += $coursefee_value;
        }

         $userData->student->installments()->create([
            'institute_id' => $auth_id,
            'created_id'  => auth()->id(),
            'amount'     => $fees,
            'student_type'=> $request->student_type,
            'mode'       => 1,
            'type'       => 2,
        ]);

         $userData->student->student_studentType()->create([
            'institute_id' => $auth_id,
            'studenttype_id' =>$request->student_type
        ]);

         foreach ($itiming_id as $key => $timing_value) {

            $student_reappear->student_batch()->create([
            'batch_id' => $timing_value,
            'student_type' => $student_reappear->student_type
            ]);
        }

         $stud_data = StudentReappear::where('student_id',$student_reappear->id)
               ->latest()
               ->first();

         $studentcourse_oldrecord =Student_course::where('student_id',$userData->student->id)
         ->where('student_type',$stud_data->student_type)
         ->get();

           foreach ($studentcourse_oldrecord as $key => $course_value) {
               if ($course_value != null) {
                     $course_value->update(['old' => 1]);
        }
           }

     foreach ($course_id as $key => $course_value) {
        $courseData = Student_course::where('course_id',$course_value)
               ->where('student_id',$userData->student->id)
               ->where('student_type',$stud_data->student_type)
               ->latest()
               ->first();

               if ($courseData != null) {
            $courseData->update(['old' => 1]);
        }
     }

       foreach ($course_id as $key => $course_value) {
               $course = Student_course::where('course_id',$course_value)
               ->where('student_id',$userData->student->id)
               ->where('student_type',$student_reappear->student_type)
               ->latest()
               ->first();

             if ($course != null) {
                $course->create([
                    'student_id'=>$course->student_id,
                    'course_id' => $course->course_id,
                    'student_type' => $request->student_type,
                    'doaddmission'=> $request->doaddmission,
                    'isession_id'=> $request->isession_id,
                    'year'=> $request->year,
                    'old' => 0,
                ]);
              }
          }

          $studentsubject_oldrecord =StudentSubject::where('student_id',$userData->student->id)
         ->where('student_type',$student_reappear->student_type)
         ->get();

           foreach ($studentsubject_oldrecord as $key => $subject_value) {

               if ($subject_value != null) {

            $subject_value->update(['old' => 0]);
          }

            }

         $studentsubject_oldrecord =StudentSubject::where('student_id',$userData->student->id)
         ->where('student_type',$stud_data->student_type)
         ->get();

           foreach ($studentsubject_oldrecord as $key => $subject_value) {
               if ($subject_value != null) {
            $subject_value->update(['old' => 1]);
        }
           }

             $grnoData =  DB::table('student_subjects')->latest('subject_grno')
             ->where('institute_id',$auth_id)
             ->first();

             $student_grno = $grnoData->subject_grno;

             foreach ($subjec_Data as $key => $subject_value) {
               $subject = StudentSubject::where('institute_id',$auth_id)
               ->where('student_id',$userData->student->id)
               ->latest()
               ->first();

              if ($subject != null) {
                $subject->create([
                    'student_id'=>$subject->student_id,
                    "institute_id" =>$subject->institute_id,
                    'subject_grno' => ++$student_grno,
                    'subject_id' => $subject_value,
                    'student_type' => $request->student_type,
                    'doaddmission'=> $request->doaddmission,
                    'isession_id'=> $request->isession_id,
                    'year'=> $request->year,
                    'old' => 0,
                ]);
              }

          $studentData = Student::with('institute')->Where('institute_id',$auth_id)->get();
          $grData =Grnumber::where('institute_id',$auth_id)->first();

        // $student_Data = Student::with('student_subject')->Where('institute_id',auth()->id())->get();
               $grnoData =  DB::table('student_grnos')->latest('student_grno')
               ->where('institute_id',$auth_id)->first();

               $student_grno = $grnoData->student_grno;

               $grno = $student_grno +1;

               $userData->student->student_grno()->create([
                    'institute_id' => $auth_id,
                    'student_grno' => $grno,
                    'student_type' =>$request->student_type,
                    'doaddmission'=> $request->doaddmission,
                    'isession_id'=> $request->isession_id,
                    'year'=> $request->year,
               ]);
            }

   return redirect()->route('studentreport.index')->with('status','Student Reappear Add Successfully.');

       }
}
