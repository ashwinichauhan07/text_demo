<?php

namespace App\Http\Controllers;

use App\Models\McqBank;
use App\Models\PractiseExam;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PractiseExamController extends Controller
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
        $examData  = PractiseExam::where('institute_id',$auth_id)->get();

//dd($examData);
        return view('practise_exam.index',compact('examData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectData = Subject::all();

        return view('practise_exam.create',compact('subjectData'));
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
     * @param  \App\Models\PractiseExam  $practiseExam
     * @return \Illuminate\Http\Response
     */
    public function show(PractiseExam $practiseExam)
    {
        return view('practise_exam.show',compact('practiseExam'));
    }


    public function show_info(PractiseExam $practiseExam){
        return view('practiseexam.show_info', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PractiseExam  $practiseExam
     * @return \Illuminate\Http\Response
     */
    public function edit(PractiseExam $practiseExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PractiseExam  $practiseExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PractiseExam $practiseExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PractiseExam  $practiseExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(PractiseExam $practiseExam)
    {
//        dd($practiseExam);
        $practiseExam->delete();

        return redirect()->route('practise_exam.index')->with('status','Practise Deleted Successfully.');
    }

    public function select_paper(Request $request)
    {
        $validator = $request->validate([
            'name'      =>   'required',
//            'code'      =>   'required',
//            'instruction'   => 'required',
//            'startExam' =>    'required',
//            'endExam'   =>    'required',
//            'duration'  =>  'required',
//            'instruction_time'  =>  'required',
//            'pass_percentage'   =>   'required',
            'subject_id'    =>  'required',
            'result'    =>  'required',

        ]);

        $paperData = McqBank::get();

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }
            $paperData = McqBank::where('institute_id',$auth_id)->get();


        return view('practise_exam.second',compact('paperData','validator'));
    }

    public function studentselect(Request $request)
    {
        $validator = $request->validate([
            'question_bank_no'  => 'required',
            'name'      =>   'required',
//            'code'      =>   'required',
//            'instruction'   => 'required',
//            'startExam' =>    'required',
//            'endExam'   =>    'required',
//            'duration'  =>  'required',
//            'instruction_time'  =>  'required',
//            'pass_percentage'   =>   'required',
            'subject_id'    =>  'required',
            'result'    =>  'required',
        ]);
//        dd('l');

        // get institute id
        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }
        $studnetData = Student::with('user')->where('institute_id',$auth_id)->get();

        return view('practise_exam.third',compact('validator','studnetData'));
    }

    public function createxam(Request $request)
    {
        $data = $request->validate([
            'question_bank_no'  => 'required',
            'name'      =>   'required',
            'subject_id'    =>  'required',
            'result'    =>  'required',
        ]);

        if (empty($request->student)) {
            return redirect()->route('practise_exam.index')->with('error','Without student Can not create exam.');
        }

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $examData = PractiseExam::create([
            'institute_id' => $auth_id,
            'user_id' => $auth_id,
            'question_bank_no' => $data['question_bank_no'],
            'name'              => $data['name'],
            'result'            => $data['result'],
        ]);

        foreach ($request->student as $key => $stu_value) {

//            dd($examData->student());
            $examData->student()->create([
                'user_id' => $stu_value,
            ]);
        }

        // Check exam have writing q or not
        $writingQ = McqBank::find($data['question_bank_no']);

        if ($writingQ->total_writing_question > 0) {
            $examData->fill(['result' => 0])->update();
        }

        return redirect()->route('practise_exam.index')->with('status','Exam Created Successfully.');
    }

}
