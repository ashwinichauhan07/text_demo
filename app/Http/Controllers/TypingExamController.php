<?php

namespace App\Http\Controllers;

use App\Models\TypingExam;
use Illuminate\Http\Request;
use App\Models\PractiseType;
use App\Models\TypingPractise;
use App\Models\Typingtest;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ExamBatches;
use App\Models\ExamName;



class TypingExamController extends Controller
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
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $TypingexamData = TypingExam::where('institute_id',$auth_id)->get();

        return view('typing_exam.index',compact('TypingexamData'));
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

        $course_arr =[];

        if(auth()->user()->userType == 2){
            foreach (auth()->user()->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        }
        else{

            foreach (auth()->user()->instructor->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        }

        $sectionData = Section::all();

        $ExamBatcheData = ExamBatches::where('institute_id',$auth_id)->get();

        $ExamName = ExamName::where('institute_id',$auth_id)->get();


        // $subjectData = Subject::all();
        return view('typing_exam.create',compact('sectionData','subjectData','ExamBatcheData','ExamName'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $dataUpload = $request->validate([
            'practise_type' => 'required',
            'subject_id' => 'required',
            'typingdata'=>'required',
            'exam_time'=>'required',
            'exam_mark'=>'required',
            'batch_name'=>'required',
            'exam_name'=>'required',

        ]);

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }
//        dd($upload);

        $practiseType = PractiseType::where('institute_id',$auth_id)->where('id',$request->practise_type)
            ->where('subject_id',$request->subject_id)->first();

//        dd($practiseType->id);
        $explode = explode(' ',$practiseType->subject->name);
//        dd($explode[0]);

        if($request->typingdata != null){

            if($request->hasfile('typingdata'))
            {
                $id = Typingtest::where('practise_type',$practiseType->id)->latest('id')->first();

//           dd($id);
                foreach($request->file('typingdata') as $key => $file)
                {

                    if ($id != null){
                        $ke = 1 + $id->key + $key;
                    }
                    else
                    {
                        $ke = 1 + $key;
                    }

                    if ($practiseType->name == "SpeedPassage30"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
                    }
                    else if ($practiseType->name == "SpeedPassage40"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
                    }
                    else if ($practiseType->name == "SpeedLetter30"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
                    }
                    else if ($practiseType->name == "SpeedLetter40"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
                    }
                    else if ($practiseType->name == "SpeedStatement30"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
                    }
                    else if ($practiseType->name == "SpeedStatement40"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
                    }
                    else if ($practiseType->name == "SpeedEmail30"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
                    }
                    else if ($practiseType->name == "SpeedEmail40"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
                    }

                    $file->move(public_path().'/typing_exam/', $name);
                    $data[] = $name;



                    $upload = TypingExam::create([
                        'institute_id' => $auth_id,
                        'practise_type' => $request->practise_type,
                        'subject_id' => $request->subject_id,
                        'exam_time' => $request->exam_time,
                        'exam_mark' => $request->exam_mark,
                        'typingdata' => $name,
                        'batch_name' => $request->batch_name,
                        'exam_name'=> $request->exam_name,
                        'key' => $ke,
                    ]);

                }
            }
        }

        return redirect()->route('typing_exam.index')->with('status','Typingtest is Created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypingExam  $typingExam
     * @return \Illuminate\Http\Response
     */
    public function show(TypingExam $typingExam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypingExam  $typingExam
     * @return \Illuminate\Http\Response
     */
    public function edit(TypingExam $typingExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypingExam  $typingExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypingExam $typingExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypingExam  $typingExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypingExam $typingExam)
    {
        // dd($typingExam);

        $typingExam->delete();

        return back()->with('error', 'Typing Exam deleted successfully.');

    }
}
