<?php

namespace App\Http\Controllers;

use App\Models\PractiseMCQTest;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Mcqtype;
use App\Models\Practisemcq;


class PractiseMCQTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mcqQuestionData = PractiseMCQTest::all();
          // dd($mcqQuestionData);
        return view('practise_mcqtestpaper.index',compact('mcqQuestionData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function automatic()
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
     // dd($subject);

        $subjectLevelData = Mcqtype::all();
             // dd($subjectLevel);

     return view('practise_mcqtestpaper.automatic', compact('subjectData', 'subjectLevelData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PractiseMCQTest  $practiseMCQTest
     * @return \Illuminate\Http\Response
     */
    public function manually()
    {
        // $subject = Subject::all();
        // dd($subject);

        if(auth()->user()->userType == 2){
            foreach (auth()->user()->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subject = Subject::whereIn('course_id',$course_arr)->get();

        }
        else if(auth()->user()->userType == 3){

            foreach (auth()->user()->instructor->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subject = Subject::whereIn('course_id',$course_arr)->get();

        }

        $subjectLevelData = Mcqtype::all();

         // dd($subjectLevelData);

        return view('practise_mcqtestpaper.manually', compact('subject',
         'subjectLevelData'));
    }

    public function automatic_create_show(Request $request)
    {


        $data = $request->validate([
            'questionPaperName'     => 'required',
            'subject_id'            => 'required',
            'mcq_type_id'                 =>  'required',
            // 'total_writing_question'=>  'required|numeric|min:0',
            'total_mcq_question'    =>  'required|numeric|min:0',
            // 'each_writing_mark'     =>  'sometimes|numeric|min:0',
            'each_mcq_mark'         =>  'required|numeric|min:0',
            // 'each_negative_writing_mark'    =>  'required|numeric|min:0',
            'each_negative_mcq_mark'    =>  'required|numeric|min:0',
            'required_time'         =>  'required|numeric|min:0',
        ]);
        // dd($request->all());



// $question = Practisemcq::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$data['mcq_type_id'],'is_mcq'=>0])
//            ->limit($data['total_writing_question'])
//            ->inRandomOrder()
//            ->get();
//
//
//        // // $question = Question::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$data['mcq_type_id'],'is_mcq'=>0])->get();
//
//
//        $questionMcq = Practisemcq::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$data['mcq_type_id'],'is_mcq'=>1])
//            ->limit($data['total_mcq_question'])
//            ->inRandomOrder()
//            ->get();


        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

            // $question = Practisemcq::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$request->mcq_type_id,'is_mcq'=>0])
            //     ->where('institute_id',$auth_id)
            //     ->limit($data['total_writing_question'])
            //     ->inRandomOrder()
            //     ->get();


            $questionMcq = Practisemcq::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$request->mcq_type_id])
                ->where('institute_id',$auth_id)
                ->limit($data['total_mcq_question'])
                ->inRandomOrder()
                ->get();
//        dd($questionMcq);


        // dd(count($question));

        // if (count($question) == 0 && count($questionMcq) == 0) {
        //     return back()->with('status','No question available.');
        // }

        $questionData = $questionMcq;
//         dd($questionData);
        // $data['total_writing_question'] = count($question);

        $data['total_mcq_question'] = count($questionMcq);


        return view('practise_mcqtestpaper.automatic_create_show',
            compact('data','questionData'));
    }




      public function automaticstore(Request $request)
    {

//        dd($request->all());
         $data = request()->validate([
            'questionPaperName'     =>  'required',
            'subject_id'            =>  'required',
            'mcq_type_id'                 =>  'required',
            // 'total_writing_question'=>  'required',
            'total_mcq_question'    =>  'required',
            // 'each_writing_mark'     =>  'required',
            'each_mcq_mark'         =>  'required',
            // 'each_negative_writing_mark'    =>  'required',
            'each_negative_mcq_mark'    =>  'required',
            'required_time'         =>  'required',
            'question'              => 'required',
        ]);

         // dd( $data);

        $institute_id = auth()->id();
        if (auth()->user()->userType != 1 && auth()->user()->userType != 2) {
            $institute_id = auth()->user()->question_bank_generator->institute_id;
           // dd($questionBankData);
        }

        $questionBankData = new PractiseMCQTest;
        $questionBankData->user_id = auth()->id();
        $questionBankData->institute_id = $institute_id;
        $questionBankData->questionPaperName = $data['questionPaperName'];
        $questionBankData->subject_id = $data['subject_id'];
        $questionBankData->level = $data['mcq_type_id'];
        // $questionBankData->total_writing_question = $data['total_writing_question'];
        $questionBankData->total_mcq_question = $data['total_mcq_question'];
        // $questionBankData->each_writing_mark = $data['each_writing_mark'];
        $questionBankData->each_mcq_mark = $data['each_mcq_mark'];
        // $questionBankData->each_negative_writing_mark = $data['each_negative_writing_mark'];
        $questionBankData->each_negative_mcq_mark = $data['each_negative_mcq_mark'];
        $questionBankData->required_time = $data['required_time'];
        $questionBankData->question = json_encode($data['question']);
        $questionBankData->save();


        return redirect()->route('practise_mcqtestpaper.index')->with('status','QuestionBank For MCQ Created Successfully.');




    }

     public function show(PractiseMCQTest $practiseMCQTest)
    {

        // dd($practiseMCQTest);
        $question = explode('"', $practiseMCQTest->question);

        foreach ($question as $key => $question_value) {
            $questionId[] = (Int) $question_value;
        }

        $questionData = Practisemcq::whereIn('id',$questionId)->get();

        // dd($questionData);

        return view('practise_mcqtestpaper.show',compact('practiseMCQTest','questionData'));
    }



    // public function show(PractiseMCQTest $practiseMCQTest){

    //     return view('practise_mcqtestpaper.show');

    // }


      public function questionmanaual(Request $request)
    {

        $data = request()->validate([
            'questionPaperName'     =>  'required',
            'subject_id'            => 'required',
            'mcq_type_id'                 =>  'required',
            // 'each_writing_mark'     =>  'required',
            'each_mcq_mark'         =>  'required',
            // 'each_negative_writing_mark'    =>  'required',
            'each_negative_mcq_mark'    =>  'required',
            'required_time'         =>  'required',
        ]);




        $questionData = Practisemcq::where(['subject_id'=>$request->subject_id])
        ->where(['mcq_type_id'=>$request->mcq_type_id])
        ->get();

//        dd($questionData);

                  if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

            $questionData = Practisemcq::where(['subject_id'=>$request->subject_id])
                ->where(['mcq_type_id'=>$request->mcq_type_id])
                ->where('institute_id',$auth_id)
                ->get();




        return view('practise_mcqtestpaper.manually_question',compact('questionData','data'));
    }



 public function manually_create_show(Request $request)
    {
//        dd($request->all());
        $data = request()->validate([
            'questionPaperName'     => 'required',
            'subject_id'            => 'required',
            'mcq_type_id'                 =>  'required',
            // 'total_writing_question'=>  'required',
            'total_mcq_question'    =>  'required',
            // 'each_writing_mark'     =>  'required',
            'each_mcq_mark'         =>  'required',
            // 'each_negative_writing_mark'    =>  'required',
            'each_negative_mcq_mark'    =>  'required',
            'required_time'         =>  'required',
            'question'              => 'required',
        ]);


     if (auth()->user()->userType == 2) {

         $auth_id = auth()->id();
     }
     else{

         $auth_id = auth()->user()->instructor->institute_id;
     }

     $questionMcq = Practisemcq::where(['subject_id'=>$request->subject_id,'mcq_type_id'=>$request->mcq_type_id,'is_mcq'=>1])
            ->where('institute_id',$auth_id)
        ->whereIn('id',$request->question)
        ->inRandomOrder()
        ->get();


     $question = Practisemcq::where(['subject_id'=>$request->subject_id,'mcq_type_id'=>$request->mcq_type_id,'is_mcq'=>0])
            ->where('institute_id',$auth_id)
        ->whereIn('id',$request->question)
        ->inRandomOrder()
        ->get();

//     dd($questionMcq);


     $questionData = $question->merge($questionMcq);

        $data['total_writing_question'] = count($question);

        $data['total_mcq_question'] = count($questionMcq);

        return view('practise_mcqtestpaper.automatic_create_show',compact('questionData','data'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PractiseMCQTest  $practiseMCQTest
     * @return \Illuminate\Http\Response
     */
    public function edit(PractiseMCQTest $practiseMCQTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PractiseMCQTest  $practiseMCQTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PractiseMCQTest $practiseMCQTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PractiseMCQTest  $practiseMCQTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PractiseMCQTest $practiseMCQTest)
    {
        //
    }
}
