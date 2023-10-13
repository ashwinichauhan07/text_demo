<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PractiseType;
use App\Models\TypingExam;
use App\Models\Student;
use App\Models\Mcqexamstudent;
use App\Models\Exam;
use App\Models\User;
use App\Models\Institute;
use App\Models\Paper;
use App\Models\ExamBatches;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\Response;



class TypingexamController extends Controller
{

    public function examlogin(Request $request)
    {
        $data = [];

        $credentials  = Validator::make($request->all(), [
            'otp' => 'required',
        ]);

        if ($credentials->fails()) {

            return response()->json([
                'status' => false,
                'message' => $credentials->errors()->all(),
                'data' => $data
            ]);
        }

        $user = Mcqexamstudent::where('exam_otp',$request->otp)->first();




        // dd($user);
        if ($user != null){

            $userdata = User::where('id',$user->user_id)->first();


            $token = $userdata->createToken($userdata->id);

            $user['token'] = $token->plainTextToken;
            $user['exam_id'] =  $user->exam_id;

            $data = [
                'data' => $user,
            ];


            return response()->json([
                'status' => true,
                'message' => 'Student credentials',
                'data' => $user
            ]);

        }
        return response()->json([
            'status' => false,
            'message' => 'login fail',
        ]);
    }

    public function startexam(Request $request){

        $data = [];

        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
                'data' => $data
            ]);
        }

        $exambatchcheck = Mcqexamstudent::where(['exam_id' => $request->exam_id, 'user_id' => auth()->id()])
            ->first();


        if ($exambatchcheck == null) {
            return response()->json([
                'status' => false,
                'message' => 'exam id not found',
                'data' => $data
            ]);
        }

        if($exambatchcheck != null){

            $examdata = TypingExam::with('practise')->where('batch_name', $exambatchcheck->exam->batch_name)
            ->get();
            // dd($examdata);
        }




        return response()->json([
            'status' => true,
            'message' => 'Passage Data',
            'data' => $examdata
        ]);
    }

    public function getpdf(Request $request){

        // dd(auth()->id());
        $data = [];

        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
                'data' => $data
            ]);
        }


        $examData = Exam::find($request->exam_id);

    if ($examData == null) {
        return response()->json([
            'status' => false,
            'message' => 'exam id not found',
            'data' => $data
        ]);
    }

        // dd($request->all());

        $institute = Institute::where('user_id',$examData->institute_id)->first();

        $answerSheetData = Paper::where(['exam_id' => $examData->id,'student_id'=> auth()->id()])
        ->get();

        $mark = 0;
        foreach ($answerSheetData as $key => $sheet_value) {
            if ($sheet_value->question->ans_right->id == $sheet_value->answer_id) {
                $mark += $examData->question_bank->each_mcq_mark;
            }
        }

        $data = [
            'total_mark' => $examData->question_bank->each_mcq_mark * $examData->question_bank->total_mcq_question,
            'mark_obtained' => $mark,
            'inst_logo' => $institute->inst_logo,
        ];


        $answerSheetData = Paper::where(['exam_id' => $request->exam_id,'student_id'=>auth()->id()])
        ->get();


    $studentData = Student::where('user_id',auth()->id())->first();

    $pdf = PDF::loadView("pdf.result",compact('examData','data','studentData','answerSheetData'));


    $path = public_path('pdf/');
    $fileName =   $request->exam_id.auth()->id().'result.' . 'pdf' ;
    $pdf->save($path . '/' . $fileName);

                $url = url("/public/pdf") . "/" . $fileName;

                return response()->json([
                    'status' => true,
                    'message' => 'Passage Data',
                    'data' => $url
                ]);


    }

    // public function pdf()
    // {
    //     // dd(';ll');
    //     $data = [
    //         'title' => 'First PDF for Medium',
    //         'heading' => 'Hello from 99Points.info',
    //         'content' => 'Lorem Ipsum is simply dummy text remaining essentially unchanged.'
    //     ];

    //     $pdf = PDF::loadView('pdf.result');
    //     return $pdf->download('result.pdf');
    // }
}
