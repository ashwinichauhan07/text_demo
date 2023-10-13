<?php

namespace App\Http\Controllers;

use App\Models\McqBank;
use App\Models\Mcqtype;
use App\Models\Practisemcq;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class McqBankController extends Controller
{
    public function decide()
    {

        $questionBankData = McqBank::where('user_id',auth()->id())
            ->get();

            // dd($questionBankData);

        return view('mcq_bank.decide',compact('questionBankData'));
    }

    public function get_question_details(Request $request)
    {
        $data = array();

        // dd($request->all());

        $subject_id = Subject::where('name',$request->subject)->first();

//        if (!is_null($subject_id)) {
//
//            $question = Question::where(['subject_id'=>$subject_id->id,'level'=>$request->level,'is_mcq'=>0])
//                ->count();
//
//            $questionMcq = Question::where(['subject_id'=>$subject_id->id,'level'=>$request->level,'is_mcq'=>1])
//                ->count();
//
//            if (auth()->user()->userType != 1) {
//
//                $institute_id = auth()->id();
//                if (auth()->user()->userType != 2) {
//                    $institute_id = auth()->user()->question_bank_generator->institute_id;
//                }
//
//                $question = Question::where(['subject_id'=>$subject_id->id,'level'=>$request->level,'is_mcq'=>0])
//                    ->where('institute_id',$institute_id)
//                    ->count();
//
//                $questionMcq = Question::where(['subject_id'=>$subject_id->id,'level'=>$request->level,'is_mcq'=>1])
//                    ->where('institute_id',$institute_id)
//                    ->count();
//            }
//
//            $data['general'] = $question;
//            $data['mcq']     = $questionMcq;
//            $data['subject_id'] = $subject_id->id;
//
//            return response()->json([
//                'status'    =>true,
//                'message'   =>"Question Data",
//                'data'      => $data,
//            ]);
//        } else {
//            return response()->json([
//                'status'    => false,
//                'message'   => 'Question Data Not Found.',
//                'data'      => $data,
//            ]);
//        }
    }

    public function automatic_create()
    {
        $subjectData = Subject::all();

        $subjectLevelData = Mcqtype::all();

        return view('mcq_bank.automatic_create',compact('subjectData','subjectLevelData'));
    }

    public function manual_create()
    {
        $subjectData = Subject::all();

        $subjectLevelData = Mcqtype::all();

        return view('mcq_bank.manual_create',compact('subjectLevelData','subjectData'));
    }

    public function automatic_create_show(Request $request)
    {
        $data = request()->validate([
            'questionPaperName'     => 'required',
            'subject_id'            => 'required',
            'mcq_type_id'                 =>  'required',
            'total_writing_question'=>  'required|numeric|min:0',
            'total_mcq_question'    =>  'required|numeric|min:0',
        ]);

// dd($data);

        $question = Practisemcq::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$data['mcq_type_id'],'is_mcq'=>0])
            ->limit($data['total_writing_question'])
            ->inRandomOrder()
            ->get();

        // // $question = Question::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$data['mcq_type_id'],'is_mcq'=>0])->get();


        $questionMcq = Practisemcq::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$data['mcq_type_id'],'is_mcq'=>1])
            ->limit($data['total_mcq_question'])
            ->inRandomOrder()
            ->get();

//        dd($questionMcq);

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

            $question = Practisemcq::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$request->mcq_type_id,'is_mcq'=>0])
                ->where('institute_id',$auth_id)
                ->limit($data['total_writing_question'])
                ->inRandomOrder()
                ->get();


            $questionMcq = Practisemcq::where(['subject_id'=>$data['subject_id'],'mcq_type_id'=>$request->mcq_type_id,'is_mcq'=>1])
                ->where('institute_id',$auth_id)
                ->limit($data['total_mcq_question'])
                ->inRandomOrder()
                ->get();
//        dd($questionMcq);


        // dd(count($question));

        if (count($question) == 0 && count($questionMcq) == 0) {
            return back()->with('status','No question available.');
        }

        $questionData = $question->merge($questionMcq);

        $data['total_writing_question'] = count($question);

        $data['total_mcq_question'] = count($questionMcq);

        return view('mcq_bank.automatic_create_show',compact('questionData','data'));
    }

    public function automatic_store(Request $request)
    {
//        dd('ll');
        $data = request()->validate([
            'questionPaperName'     =>  'required',
            'subject_id'            =>  'required',
            'mcq_type_id'                 =>  'required',
            'total_writing_question'=>  'required',
            'total_mcq_question'    =>  'required',
//            'each_writing_mark'     =>  'required',
//            'each_mcq_mark'         =>  'required',
//            'each_negative_writing_mark'    =>  'required',
//            'each_negative_mcq_mark'    =>  'required',
//            'required_time'         =>  'required',
            'question'              => 'required',
        ]);

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $questionBankData = new McqBank();
        $questionBankData->user_id = auth()->id();
        $questionBankData->institute_id = $auth_id;
        $questionBankData->questionPaperName = $data['questionPaperName'];
        $questionBankData->subject_id = $data['subject_id'];
        $questionBankData->level = $data['mcq_type_id'];
        $questionBankData->total_writing_question = $data['total_writing_question'];
        $questionBankData->total_mcq_question = $data['total_mcq_question'];
//        $questionBankData->each_writing_mark = $data['each_writing_mark'];
//        $questionBankData->each_mcq_mark = $data['each_mcq_mark'];
//        $questionBankData->each_negative_writing_mark = $data['each_negative_writing_mark'];
//        $questionBankData->each_negative_mcq_mark = $data['each_negative_mcq_mark'];
//        $questionBankData->required_time = $data['required_time'];
        $questionBankData->question = json_encode($data['question']);
        $questionBankData->save();

        return redirect()->route('mcq_bank.decide')->with('status','QuestionBank Created Successfully.');
    }

    public function questionmanaual(Request $request)
    {
//        dd($request->all());
        $data = request()->validate([
            'questionPaperName'     =>  'required',
            'subject_id'            => 'required',
            'mcq_type_id'                 =>  'required',
//            'each_writing_mark'     =>  'required',
//            'each_mcq_mark'         =>  'required',
//            'each_negative_writing_mark'    =>  'required',
//            'each_negative_mcq_mark'    =>  'required',
//            'required_time'         =>  'required',
        ]);

        $questionData = Practisemcq::where(['subject_id'=>$request->subject_id])
            ->where(['mcq_type_id'=>$request->mcq_type_id])
            ->get();

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }


//        if (auth()->user()->userType != 1) {
//
//            $institute_id = auth()->id();
//            if (auth()->user()->userType != 2) {
//                $institute_id = auth()->user()->question_bank_generator->institute_id;
//            }

            $questionData = Practisemcq::where(['subject_id'=>$request->subject_id])
                ->where(['mcq_type_id'=>$request->mcq_type_id])
                ->where('institute_id',$auth_id)
                ->get();

//        }


        return view('mcq_bank.manual_question',compact('questionData','data'));
    }

    public function show(McqBank $mcq_bank)
    {
        $mcqData = explode('"', $mcq_bank->question);

//        dd($mcqData);

        foreach ($mcqData as $key => $question_value) {
            $questionId[] = (Int) $question_value;
        }

        $questionData = Practisemcq::whereIn('id',$questionId)->get();

//        dd($questionData);

        return view('mcq_bank.show',compact('mcq_bank','questionData'));
    }

    public function manauallyQuestionShow(Request $request)
    {
//        dd('ll');
        $data = request()->validate([
            'questionPaperName'     => 'required',
            'subject_id'            => 'required',
            'mcq_type_id'                 =>  'required',
            'total_writing_question'=>  'required',
            'total_mcq_question'    =>  'required',
//            'each_writing_mark'     =>  'required',
//            'each_mcq_mark'         =>  'required',
//            'each_negative_writing_mark'    =>  'required',
//            'each_negative_mcq_mark'    =>  'required',
//            'required_time'         =>  'required',
            'question'              => 'required',
        ]);



        $question = Practisemcq::where(['subject_id'=>$request->subject_id,'mcq_type_id'=>$request->mcq_type_id,'is_mcq'=>1])
            ->whereIn('id',$request->question)
            ->inRandomOrder()
            ->get();

        $questionMcq = Practisemcq::where(['subject_id'=>$request->subject_id,'mcq_type_id'=>$request->mcq_type_id,'is_mcq'=>0])
            ->whereIn('id',$request->question)
            ->inRandomOrder()
            ->get();

        $questionData = $question->merge($questionMcq);

        $data['total_writing_question'] = count($question);

        $data['total_mcq_question'] = count($questionMcq);

        return view('mcq_bank.automatic_create_show',compact('questionData','data'));
    }
    public function destroy(McqBank $mcq_bank)
    {
        $mcq_bank->delete();

        return redirect()->route('mcq_bank.decide')->with('status','Question papaer Delete Successfully.');
    }
}
