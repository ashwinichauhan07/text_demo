<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Mcqtype;
use App\Models\Question;
use App\Models\QuestionBank;

class QuestionBankController extends Controller
{
    public function decide()
    {
        $questionBankData = QuestionBank::all();
       // dd($questionBankData);
        // if (auth()->user()->userType != 1) {

        //     if (auth()->user()->userType == 2) {

                // $generaterId = QuestionBankGenerators::with('user')
                // ->where('institute_id',auth()->id())
                // ->get()->pluck('user_id');

                // $questionBankData = QuestionBank::where('user_id',auth()->id())
                // ->orWhereIn('user_id',auth()->id())
                // ->get();

            // } else {
                $questionBankData = QuestionBank::where('user_id',auth()->id())
                ->get();
            // }
        // }

        return view('question_bank.decide',compact('questionBankData'));
    }

    public function get_question_details(Request $request)
    {
        $data = array();

        $subject_id = Subject::where('name',$request->subject)->first();

        if (!is_null($subject_id)) {

            $question = Question::where(['subject_id'=>$subject_id->id,'level'=>$request->level,'is_mcq'=>0])
            ->count();

            $questionMcq = Question::where(['subject_id'=>$subject_id->id,'level'=>$request->level,'is_mcq'=>1])
            ->count();

            if (auth()->user()->userType != 1) {

                $institute_id = auth()->id();
                if (auth()->user()->userType != 2) {
                    $institute_id = auth()->user()->question_bank_generator->institute_id;
                }

                $question = Question::where(['subject_id'=>$subject_id->id,'level'=>$request->level,'is_mcq'=>0])
                            ->where('institute_id',$institute_id)
                            ->count();

                $questionMcq = Question::where(['subject_id'=>$subject_id->id,'level'=>$request->level,'is_mcq'=>1])
                                ->where('institute_id',$institute_id)
                                ->count();
            }

            $data['general'] = $question;
            $data['mcq']     = $questionMcq;
            $data['subject_id'] = $subject_id->id;

            return response()->json([
                'status'    =>true,
                'message'   =>"Question Data",
                'data'      => $data,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Question Data Not Found.',
                'data'      => $data,
            ]);
        }
    }


    public function automatic_create()
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

        $subjectLevelData = Mcqtype::all();

        return view('question_bank.automatic_create',compact('subjectData','subjectLevelData'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manual_create()
    {

        return view('question_bank.manual_create');
    }

    public function automatic_create_show(Request $request)
    {
        $data = request()->validate([
            'questionPaperName'     => 'required',
            'total_mcq_question'    =>  'required|numeric|min:0',
            'each_mcq_mark'         =>  'required|numeric|min:0',
            'each_negative_mcq_mark'    =>  'required|numeric|min:0',
            'required_time'         =>  'required|numeric|min:0',
        ]);

        // $question = Question::where(['is_mcq'=>0])
        // ->inRandomOrder()
        // ->get();

       // // $question = Question::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$data['mcq_type_id'],'is_mcq'=>0])->get();

         // dd($question);



        $questionMcq = Question::limit($data['total_mcq_question'])
        ->inRandomOrder()
        ->get();

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
         }
         else{

             $auth_id = auth()->user()->instructor->institute_id;
         }


        // dd($questionMcq);



            // $question = Question::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$request->mcq_type_id,'is_mcq'=>0])
            //     ->where('institute_id',$auth_id)
            //     ->limit($data['total_writing_question'])
            //     ->inRandomOrder()
            //     ->get();

            $questionData = Question::where('institute_id',$auth_id)
                ->limit($data['total_mcq_question'])
                ->inRandomOrder()
                ->get();
        // }

        // dd(count($question));

        // if (count($question) == 0 && count($questionMcq) == 0) {
        //     return back()->with('status','No question available.');
        // }

        // $questionData = $question->merge($questionMcq);
        // dd($questionData);
        // $data['total_writing_question'] = count($question);

        $data['total_mcq_question'] = count($questionMcq);

        return view('question_bank.automatic_create_show',compact('questionData','data'));
    }

    public function show(QuestionBank $questionBank)
    {
        $question = explode('"', $questionBank->question);

        foreach ($question as $key => $question_value) {
            $questionId[] = (Int) $question_value;
        }

        $questionData = Question::whereIn('id',$questionId)->get();
        return view('question_bank.show',compact('questionBank','questionData'));
    }

    public function automatic_store(Request $request)
    {
         // dd($request->all);
         $data = request()->validate([
            'questionPaperName'     =>  'required',
            'each_mcq_mark'         =>  'required',
            'each_negative_mcq_mark'    => 'required',
            'required_time'         =>  'required',
            'total_mcq_question'         =>  'required',
            'question'         =>  'required',
        ]);

         // dd( $data);

        $institute_id = auth()->id();
        if (auth()->user()->userType != 1 && auth()->user()->userType != 2) {
            $institute_id = auth()->user()->question_bank_generator->institute_id;
//             dd($questionBankData);
        }

        $questionBankData = new QuestionBank;
        $questionBankData->user_id = auth()->id();
        $questionBankData->institute_id = $institute_id;
        $questionBankData->questionPaperName = $data['questionPaperName'];
        $questionBankData->total_mcq_question = $data['total_mcq_question'];
        $questionBankData->each_mcq_mark = $data['each_mcq_mark'];
        $questionBankData->each_negative_mcq_mark = $data['each_negative_mcq_mark'];
        $questionBankData->required_time = $data['required_time'];
        $questionBankData->question = json_encode($data['question']);
        $questionBankData->save();



        return redirect()->route('question_bank.decide')->with('status','QuestionBank Created Successfully.');

    }

     public function questionmanaual(Request $request)
    {
        $data = request()->validate([
            'questionPaperName'     =>  'required',
            'each_mcq_mark'         =>  'required',
            'each_negative_mcq_mark'    => 'required',
            'required_time'         =>  'required',
        ]);

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
         }
         else{

             $auth_id = auth()->user()->instructor->institute_id;
         }

            $questionData = Question::where('institute_id',$auth_id)
                ->get();

// dd($questionData);


        return view('question_bank.manual_question',compact('questionData','data'));
    }
    public function manauallyQuestionShow(Request $request)
    {

        // dd('ll');
        $data = request()->validate([
            'questionPaperName'     =>  'required',
            'each_mcq_mark'         =>  'required',
            'each_negative_mcq_mark'    => 'required',
            'required_time'         =>  'required',
        ]);

// dd($data);


        $question = Question::whereIn('id',$request->question)
        ->inRandomOrder()
        ->get();

        // dd($question);


        $questionMcq = Question::where(['is_mcq'=>0])
        ->whereIn('id',$request->question)
        ->inRandomOrder()
        ->get();



        $questionData = $question->merge($questionMcq);

        $data['total_mcq_question'] = count($question);

        // $data['total_mcq_question'] = count($questionMcq);

        return view('question_bank.automatic_create_show',compact('questionData','data'));
    }



    public function destroy(QuestionBank $questionBank)
    {
        // dd($questionBank);

        $questionBank->delete();

        return back()->with('error', 'Question Bank deleted successfully.');

    }



}
