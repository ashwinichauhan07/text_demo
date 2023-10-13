<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Mcqexamstudent;
use App\Models\Institute;
use App\Models\Paper;
use App\Models\Question;
use App\Notifications\ExamEnd;
use Faker\Provider\cs_CZ\DateTime;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


class StudentMcqTestController extends Controller
{
    public function mcqdashboard()
    {

        // dd(auth()->user());
        $examId = Mcqexamstudent::where('user_id',auth()->id())->get()->pluck('exam_id')->toArray();

        $examData = Exam::whereIn('id',$examId)->where('endExam','>',now())
            ->orderBy('startExam','desc')
            ->get();




        $inst_logo = Institute::where('user_id', auth()->user()->student->institute_id)->first();


        return view('student_mcqtest.dashboard',compact('examData','inst_logo'));
    }

    public function index(Request $request)
    {

        // dd($request->all());
        // check for end exam notice
        $examEndNotice = auth()->user()->notifications;

//        dd($examEndNotice);

        for ($i=0; $i < count($examEndNotice); $i++) {
            if ($examEndNotice[$i]->type == "App\Notifications\ExamEnd") {
//                dd($request->exam_id);
                if ($examEndNotice[$i]->data['exam_id'] == $request->exam_id) {

                    // $exam_id = Exam::where(['id' => $request->exam_id])->first();

                    $exam_id = Mcqexamstudent::where(['exam_id' => $request->exam_id, 'user_id' => auth()->id()])->first();

                    // dd($examEndNotice);


                    return redirect()->route('student_mcqtest.dashboard')->with('status','Exam Ended, You can give your next exam using otp '.$exam_id->exam_otp);
                }

            }

        }

        $data = Exam::where(['id' => $request->exam_id])->first();


        $exam_end_date = explode(" ", $data->endExam);

        $endDateTime = explode(":", $exam_end_date[1]);

        $question = explode('"', $data->question_bank->question);

        $que_count = Question::whereIn('id',$question)->count();

        // dd($que_count);


        $questionData = Question::whereIn('id',$question)->inRandomOrder()->limit($que_count)->get();

        foreach ($questionData as $key => $que_value) {
        //    dd($que_value->paper_ans);
            $que_value->paper_ans = Paper::where(['exam_id'=>$data->id])
                ->where(['student_id' => auth()->id(),'question_id' => $que_value->id])
                ->first();
        }

        $page = 0;

//        dd($request->all());

        if (isset($request->page) && !empty($request->page)) {
            $page = (Int) $request->page - 1;
        }

        // if next btn is pressed
        if (isset($request->next) && !empty($request->next)) {
            $page++;
        }

        // if next btn is pressed
        if (isset($request->previous) && !empty($request->previous)) {
            $page = $page - 1;
        }

        // if isset answer
        if (isset($request->que) && !empty($request->que) && isset($request->ans)) {

            $ans = (Int) $request->ans;

            if ($ans != 0) {

                $paperData = Paper::updateOrCreate([
                    'exam_id'       => $data->id,
                    'student_id'    => auth()->id(),
                    'question_id'   => $request->que,
                ],
                    [
                        'answer_id'     =>  $request->ans,
                    ]);
            } else {

                $paperData = Paper::updateOrCreate([
                    'exam_id'       => $data->id,
                    'student_id'    => auth()->id(),
                    'question_id'   => $request->que,
                ],
                    [
                        'ans'     =>  $request->ans,
                    ]);

            }

        }

        return view('student_mcqtest.index',compact('questionData','data','page','endDateTime'));
    }

    public function resultgeneratepreview(Request $request)
    {

                // dd($request->all());

        $examData = Exam::find($request->exam);

        // dd($examData);
        $institute = Institute::where('user_id',$examData->institute_id)->first();

//        dd($institute->inst_logo);

        $answerSheetData = Paper::where(['exam_id' => $examData->id,'student_id'=>auth()->id()])
            ->get();

        // calculate wright question
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

    // dd($examData->question_bank);

        $pdf = PDF::loadView("pdf.result",compact('examData','answerSheetData','data'));

        // generte notice of ending exam.
        auth()->user()->notify(new ExamEnd($examData));


        $examotp = Mcqexamstudent::where('exam_id',$request->exam)->where('user_id',auth()->id())->first();

        $number = mt_rand(0, 9999);

        $otpdata = $examotp->update([
           'exam_otp' => $number
        ]);

        if($otpdata == true){

            $examotp = Mcqexamstudent::where('exam_id',$request->exam)->where('user_id',auth()->id())->first();
        }

        // Http::post('http://localhost/eswift/student/preview?exam=16');

        $path = public_path('pdf/');
        $fileName =   $request->exam.auth()->id().'result.' . 'pdf' ;
        $pdf->save($path . '/' . $fileName);

        return redirect()->route('student_mcqtest.dashboard')->with("success",'Your MCQ Exam is finished You can give your next exam using otp '.$examotp->exam_otp);


        // return $pdf->stream('result.pdf');
    }

    public function end_exam_notify (Request $request) {
        $examData = Exam::find($request->exam);

        $examotp = Mcqexamstudent::where('exam_id',$request->exam)->where('user_id',auth()->id())->first();

        $number = mt_rand(0, 9999);

        $data = $examotp->update([
           'exam_otp' => $number
        ]);

        if($data == true){

            $examotp = Mcqexamstudent::where('exam_id',$request->exam)->where('user_id',auth()->id())->first();
        }


        // dd($examotp->exam_otp);

        auth()->user()->notify(new ExamEnd($examData));

        return redirect()->route('student_mcqtest.dashboard')->with("success",'Your MCQ Exam is finished You can give your next exam using otp '.$examotp->exam_otp);
    }

}
