<?php

namespace App\Http\Controllers;

use App\Models\StudentBatchAllocation;
use App\Models\Student;
use App\Models\ExamBatches;
use App\Models\ExamStudent;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\ExamName;
use App\Models\PractiseType;
use App\Models\StudentSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentBatchAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
         }
         else{

             $auth_id = auth()->user()->instructor->institute_id;
         }

         $exmBatch =StudentBatchAllocation::where('institute_id',$auth_id)->get();

        //  dd($exmBatch);


       return view('studentbatchallocation.index',compact('exmBatch'));
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
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        if(auth()->user()->userType == 2){
            foreach (auth()->user()->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        }
        else if(auth()->user()->userType == 3){

            foreach (auth()->user()->instructor->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        }

        $ExamBatcheData = ExamBatches::where('institute_id',$auth_id)->get();

        $ExamName = ExamName::where('institute_id',$auth_id)->get();





        $studnetData = Student::with('user')->where('institute_id',$auth_id)->get();

        return view('studentbatchallocation.create', compact('subjectData','ExamBatcheData','studnetData','ExamName'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function select_student(Request $request)
    {
        // dd($request->all());
        $validator = $request->validate([
            'batch_name'    =>  'required',
            'subject_id'    =>  'required',
            'exam_name'    =>  'required',

        ]);

        // dd($validator);

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $student_subject = StudentSubject::where('subject_id',$request->subject_id)->pluck('student_id');

        // dd($student_subject);

        $exam_batch = StudentBatchAllocation::where('batch_name',$request->batch_name)
        ->where('subject_id',$request->subject_id)
        ->where('institute_id',$auth_id)
        ->where('exam_name',$request->exam_name)
        ->pluck('id');
        // ->get();

        if($exam_batch != null){

            $exam_student = ExamStudent::whereIn('student_batch_allocation_id',$exam_batch)
            ->pluck('user_id');
            // dd($exam_batch);

            $studnetData = Student::with('user')->where('institute_id',$auth_id)
            ->whereIn('id',$student_subject)
            ->whereNotIn('user_id',$exam_student)
            ->get();

            // dd($studnetData);

        }
        else{

            $studnetData = Student::with('user')->where('institute_id',$auth_id)
            ->whereIn('id',$student_subject)
            ->get();



        }


        return view('studentbatchallocation.select_student', compact('validator','studnetData'));

    }

    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'batch_name'    =>  'required',
            'subject_id'    =>  'required',
            'exam_name'    =>  'required',
        ]);

        if (empty($request->student)) {

            return redirect()->route('studentbatchallocation.index')->with('error','Without student Can not create exam.');
        }

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $exam_batch = ExamBatches::where('batch_number',$request->batch_name)->first();


        $examData = StudentBatchAllocation::create([
            'institute_id' => $auth_id,
            'exambatches_id' => $data['batch_name'],
            'batch_name'  => $data['batch_name'],
            'exam_name'  => $data['exam_name'],
            'subject_id'  => $data['subject_id'],

        ]);


        $exam = Exam::where('batch_name',$request->batch_name)->first();

        if($exam != null){

            // dd($examData->mcqstudent());

            foreach ($request->student as $key => $stu_value) {

                $examData->mcqstudent()->create([
                'user_id' => $stu_value,
                'exam_id' => $exam->id
                ]);
            }


        }


        // dd($examData->student());


        foreach ($request->student as $key => $stu_value) {

            $examData->student()->create([
            'user_id' => $stu_value,
            ]);
        }

        return redirect()->route('studentbatchallocation.index')->with('status','Exam Created Successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentBatchAllocation  $studentBatchAllocation
     * @return \Illuminate\Http\Response
     */
    public function show(StudentBatchAllocation $studentBatchAllocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentBatchAllocation  $studentBatchAllocation
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentBatchAllocation $studentBatchAllocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentBatchAllocation  $studentBatchAllocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentBatchAllocation $studentBatchAllocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentBatchAllocation  $studentBatchAllocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentBatchAllocation $studentBatchAllocation)
    {

        // dd($studentBatchAllocation);
         $studentBatchAllocation->delete();

     return back()->with('error', 'Exam Batch deleted successfully.');


    }

    public function examwise_batchname(Request $request)
    {

        // dd('ll');
        $data = [];
        $validate = Validator::make($request->all(),[
            'exam_name' => "required",
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

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        //  dd($validate->validated()['course_id']);

        // $subjectData = Subject::where('course_id',$validate->validated()['course_id'])->get();

         $batchname = ExamBatches::with('subject')->where('exam_name',$validate->validated()['exam_name'])->get();

        //  dd($batchname);

        //  $practise_type = PractiseType::where('subject_id',$batchname->subject_id)
        //  ->Where("institute_id", $auth_id)
        //  ->Where("practise_type", 1)
        //  ->get();


        //  $data['subject'] =  $batchname;
        //  $data['practise_type'] =  $practise_type;



        //  dd($subjectData);


        // dd($validate->validated()['course_id']);
        return response()->json([
                'status' => true,
                'message' => "subjectData list",
                'data' => $batchname,
            ]);
        //dd($subjectData);
        //dd($validate->fails());
        //dd($validate->validated()['course_id']);

    }

    public function batchwisesubject(Request $request)
    {

        // dd('ll');
        $data = [];
        $validate = Validator::make($request->all(),[
            'batch_name' => "required",
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

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        //  dd($validate->validated()['course_id']);

        // $subjectData = Subject::where('course_id',$validate->validated()['course_id'])->get();

         $subjectData = ExamBatches::with('subject')->where('id',$validate->validated()['batch_name'])->first();

         $practise_type = PractiseType::where('subject_id',$subjectData->subject_id)
         ->Where("institute_id", $auth_id)
         ->Where("practise_type", 1)
         ->get();


         $data['subject'] =  $subjectData;
         $data['practise_type'] =  $practise_type;



        //  dd($subjectData);


        // dd($validate->validated()['course_id']);
        return response()->json([
                'status' => true,
                'message' => "subjectData list",
                'data' => $data,
            ]);
        //dd($subjectData);
        //dd($validate->fails());
        //dd($validate->validated()['course_id']);

    }
}
