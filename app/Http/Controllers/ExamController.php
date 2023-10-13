<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\QuestionBank;
use App\Models\User;
use App\Models\Section;
use App\Models\ExamBatches;
use App\Models\StudentSubject;
use App\Models\Mcqexamstudent;
use App\Models\StudentBatchAllocation;
use App\Models\Student;
use App\Models\ExamStudent;
use App\Models\ExamName;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
       return view('demoexam.dashboard');
    }
    public function index()
    {
        $examData  = Exam::all();

        $examRecord = Exam::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(startExam) as day_name"), \DB::raw("DAY(startExam) as day"))
            ->where('startExam','>',Carbon::today()->subDay(6))
            ->groupBy('day_name','day')
            ->orderBy('day','desc')
            ->get();

        // // if user is intitute
        // if (auth()->user()->userType != 1) {

        //     if (auth()->user()->userType == 2) {

        //         $conductor = ExamConductor::with('user')->where('institute_id',auth()->id())
        //         ->get()
        //         ->pluck('user_id');

        //          $examData  = Exam::where('user_id',auth()->id())
        //                     ->orWhereIn('user_id',$conductor)
        //                     ->get();


        //         $examId  = Exam::where('user_id',auth()->id())
        //                     ->orWhereIn('user_id',$conductor)
        //                     ->get()->pluck('id');


        //          $examRecord = Exam::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(startExam) as day_name"), \DB::raw("DAY(startExam) as day"))
        //         ->where('startExam','>',Carbon::today()->subDay(6))
        //         ->whereIn('id',$examId)
        //         ->groupBy('day_name','day')
        //         ->orderBy('day','desc')
        //         ->get();

        //     } else {
        //         $examData  = Exam::where('user_id',auth()->id())->get();

        //         // $examId  = Exam::where('user_id',auth()->id())->get();

        //         $examRecord = Exam::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(startExam) as day_name"), \DB::raw("DAY(startExam) as day"))
        //         ->where('startExam','>',Carbon::today()->subDay(6))
        //         ->whereIn('id',$examId)
        //         ->groupBy('day_name','day')
        //         ->orderBy('day','desc')
        //         ->get();
        //     }


        //  }

        $data = [];
        foreach ($examRecord as $key => $exam_value) {
            $data['label'][] = $exam_value->day;
            $data['data'][] = $exam_value->count;
        }

        $data['chart_data'] = json_encode($data);

        return view('exam.index',compact('examData'),$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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


        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $course_arr =[];

        $sectionData = Section::all();

        $ExamBatcheData = ExamBatches::where('institute_id',$auth_id)->get();

        $ExamName = ExamName::where('institute_id',$auth_id)->get();



        return view('exam.create',compact('sectionData','subjectData','ExamBatcheData','ExamName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return view('exam.show',compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->route('exam.index')->with('status','Exam Deleted Successfully.');
    }

    public function select_paper(Request $request)
    {

        // dd($request->all());
        $validator = $request->validate([

            'batch_name' => 'required',
            'instruction'   => 'required',
            'exam_name' => 'required',
            'startExam' =>    'required',
            'endExam'   =>    'required',
            'duration'  =>  'required',
            'instruction_time'  =>  'required',
            'pass_percentage'   =>   'required',
            'subject_id'    =>  'required',
            // 'result'    =>  'required',

        ]);

        $paperData = QuestionBank::get();


        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $paperData = QuestionBank::where('institute_id',$auth_id)->get();



        return view('exam.second',compact('paperData','validator'));
    }


    public function studentselect(Request $request)
    {

        // dd($request->all());
        $validator = $request->validate([
            'question_bank_no'  => 'required',
            'batch_name' => 'required',
            'exam_name' => 'required',
            'instruction'   => 'required',
            'startExam' =>    'required',
            'endExam'   =>    'required',
            'duration'  =>  'required',
            'instruction_time'  =>  'required',
            'pass_percentage'   =>   'required',
            'subject_id'    =>  'required',
            // 'result'    =>  'required',
        ]);

        // get institute id
        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $student_subject = StudentSubject::where('subject_id',$request->subject_id)->pluck('student_id');

        $exam = Exam::where('batch_name',$request->batch_name)
        ->where('subject_id',$request->subject_id)
        ->where('institute_id',$auth_id)
        ->pluck('id');

      if($exam != null){

        $exam_student = Mcqexamstudent::whereIn('exam_id',$exam)
        ->pluck('user_id');
        // dd($exam_batch);

        $studnetData = Student::with('user')->where('institute_id',$auth_id)
        ->whereIn('id',$student_subject)
        ->whereNotIn('user_id',$exam_student)
        ->get();


      }
      else{
        $studnetData = Student::with('user')->where('institute_id',$auth_id)
        ->whereIn('id',$student_subject)
        ->get();
      }


// dd($exam);


        // $studnetData = Student::with('user')->where('institute_id',$auth_id)->get();

       return view('exam.third',compact('validator','studnetData'));
    }

    public function createxam(Request $request)
    {

        // dd($request->student);

        $data = $request->validate([
            'question_bank_no'  => 'required',
            'startExam' =>    'required',
            'batch_name' => 'required',
            'exam_name' => 'required',
            'endExam'   =>    'required',
            'duration'  =>  'required',
            'instruction_time'  =>  'required',
            'pass_percentage'   =>   'required',
            'subject_id'    =>  'required',
            // 'result'    =>  'required',
            'instruction'   => 'required'
        ]);




        // if (empty($request->student)) {
        //     return redirect()->route('exam.index')->with('error','Without student Can not create exam.');
        // }


        // $start = explode(" ", $data['startExam']);

                // dd($request->startExam);

        // $start_time = explode("/", $start[1]);

        // $end = explode(" ", $data['endExam']);
        // $end_time = explode("/", $end[1]);

        $exam_conductor_id = auth()->id();
        if (auth()->user()->userType != 1 && auth()->user()->userType != 2) {
            auth()->user()->exam_conductor->institute_id;
        }


        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }
//                dd($data['result']);



        $studentbatch_id = StudentBatchAllocation::where('institute_id',$auth_id)->where('exambatches_id', $request->batch_name)
        ->pluck('id');


        $findStudent = ExamStudent::whereiN('student_batch_allocation_id', $studentbatch_id)->get();

        // dd($findStudent);


        $examData = Exam::create([
            'institute_id' => $auth_id,
            'user_id' => auth()->id(),
            'question_bank_no' => $data['question_bank_no'],
            'subject_id'              => $data['subject_id'],
            'batch_name'  => $data['batch_name'],
            'exam_name' =>  $data['exam_name'],
            'instruction'   => $data['instruction'],
            'startExam' => $request->startExam,
            'endExam'   => $request->endExam,
            'duration'  => $data['duration'],
            'instruction_time'  => $data['instruction_time'],
            'pass_percentage'   => $data['pass_percentage'],
            // 'result'            => $data['result'],
        ]);




        foreach ($findStudent as $key => $stu_value) {
            $examData->student()->create([
            'user_id' => $stu_value->user_id,
            'student_batch_allocation_id' => $stu_value->student_batch_allocation_id,
            ]);
        }

        // Check exam have writing q or not
        $writingQ = QuestionBank::find($data['question_bank_no']);

        if ($writingQ->total_writing_question < 0) {

//            dd($examData);

            $examData->fill(['result' => 0])->update();
        }

        return redirect()->route('exam.index')->with('status','Exam Created Successfully.');
    }
}
