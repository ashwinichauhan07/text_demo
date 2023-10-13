<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MCQPractiseExam;
use App\Models\Subject;
use App\Models\PractiseMCQTest;
use App\Models\Student;
use Carbon\Carbon;



class MCQPractiseExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_exam()
    {
        $examData  = MCQPractiseExam::all();

        $examRecord = MCQPractiseExam::select(\DB::raw("COUNT(*) as count"),
         \DB::raw("DAYNAME(startExam) as day_name"), \DB::raw("DAY(startExam) as day"))
            ->where('startExam','>',Carbon::today()->subDay(6))
            ->groupBy('day_name','day')
            ->orderBy('day','desc')
            ->get();


             $data = [];
            foreach ($examRecord as $key => $exam_value) {
            $data['label'][] = $exam_value->day;
            $data['data'][] = $exam_value->count;
        }

        $data['chart_data'] = json_encode($data);






        return view('practiseexam.index_exam', compact('examData'),$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_exam()
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

        return view('practiseexam.create_exam', compact('subjectData'));
    }


     public function select_paper(Request $request)
    {
         $validator = $request->validate([
            'name'      =>   'required',
            'code'      =>   'required',
            'instruction'   => 'required',
            'startExam' =>    'required',
            'endExam'   =>    'required',
            'duration'  =>  'required',
            'instruction_time'  =>  'required',
            'pass_percentage'   =>   'required',
            'subject_id'    =>  'required',
            'result'    =>  'required',

        ]);

        $paperData = PractiseMCQTest::get();

        if (auth()->user()->userType != 1) {
            $institute_id = auth()->user()->id;
            if (auth()->user()->userType != 2) {
                $institute_id = auth()->user()->exam_conductor->institute_id;
            }
            $paperData = PractiseMCQTest::where('institute_id',$institute_id)->get();
        }


        return view('practiseexam.select_paper', compact('paperData','validator'));
    }


    public function select_student(Request $request)
    {
          $validator = $request->validate([
            'question_bank_no'  => 'required',
            'name'      =>   'required',
            'code'      =>   'required',
            'instruction'   => 'required',
            'startExam' =>    'required',
            'endExam'   =>    'required',
            'duration'  =>  'required',
            'instruction_time'  =>  'required',
            'pass_percentage'   =>   'required',
            'subject_id'    =>  'required',
            'result'    =>  'required',
        ]);

        // get institute id
        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $studnetData = Student::with('user')->where('institute_id',$auth_id)->get();


        return view('practiseexam.select_student', compact('validator','studnetData'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_exam(Request $request)
    {

        // dd($request->all());
         $data = $request->validate([
            'question_bank_no'  => 'required',
            'name'      =>   'required',
            'code'      =>   'required',
            'startExam' =>    'required',
            'endExam'   =>    'required',
            'duration'  =>  'required',
            'instruction_time'  =>  'required',
            'pass_percentage'   =>   'required',
            'subject_id'    =>  'required',
            'result'    =>  'required',
            'instruction'   => 'required'
        ]);


        if (empty($request->student)) {
            return redirect()->route('practiseexam.index_exam')->with('error','Without student Can not create exam.');
        }

        // dd($request->instruction);

        $start = explode(" ", $data['startExam']);
        $start_time = explode("/", $start[1]);

        $end = explode(" ", $data['endExam']);
        $end_time = explode("/", $end[1]);

        $exam_conductor_id = auth()->id();
        if (auth()->user()->userType != 1 && auth()->user()->userType != 2) {
            auth()->user()->exam_conductor->institute_id;
        }

//                dd($data['result']);


        $examData = MCQPractiseExam::create([
            'institute_id' => auth()->id(),
            'user_id' => auth()->id(),
            'question_bank_no' => $data['question_bank_no'],
            'name'              => $data['name'],
            'code'  => $data['code'],
            'instruction'   => $data['instruction'],
            'startExam' => $start_time[2]."-".$start_time[0]."-".$start_time[1]." ".$start[0],
            'endExam'   => $end_time[2]."-".$end_time[0]."-".$end_time[1]." ".$end[0],
            'duration'  => $data['duration'],
            'instruction_time'  => $data['instruction_time'],
            'pass_percentage'   => $data['pass_percentage'],
            'result'            => $data['result'],
        ]);


         // dd($examData->student());



        foreach ($request->student as $key => $stu_value) {
            $examData->student()->create([
            'user_id' => $stu_value,
            ]);
        }


        // Check exam have writing q or not
        $writingQ = PractiseMCQTest::find($data['question_bank_no']);

        if ($writingQ->total_writing_question < 0) {

//            dd($examData);

            $examData->fill(['result' => 0])->update();


        }

        return redirect()->route('practiseexam.index_exam')->with('status','Exam Created Successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MCQPractiseExam  $mCQPractiseExam
     * @return \Illuminate\Http\Response
     */
    public function show(MCQPractiseExam $mCQPractiseExam)
    {

     // dd($mCQPractiseExam);

        return view('practiseexam.show', compact('mCQPractiseExam'));
    }

    public function show_info($id){

        // dd($id);
        $student = Student::find($id);

        // dd($student);

        return view('practiseexam.show_info', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MCQPractiseExam  $mCQPractiseExam
     * @return \Illuminate\Http\Response
     */
    public function edit(MCQPractiseExam $mCQPractiseExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MCQPractiseExam  $mCQPractiseExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MCQPractiseExam $mCQPractiseExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MCQPractiseExam  $mCQPractiseExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(MCQPractiseExam $mCQPractiseExam)
    {
         $mCQPractiseExam->delete();

        return redirect()->route('practiseexam.index_exam')->with('status','Exam Deleted Successfully.');
    }
}
