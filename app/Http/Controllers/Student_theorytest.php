<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\MCQPractiseExam;
use App\Models\Practisemcq;
use App\Models\Student;
use App\Models\TestPaper;
use App\Models\TestStudent;
use Illuminate\Http\Request;
use PHPUnit\Util\Test;
use PDF;


class Student_theorytest extends Controller
{
    public function studenttheorytest()
    {


//        $student_data = Student::where('user_id', auth()->id())->first();

        $examId = TestStudent::where('user_id',auth()->id())->get()->pluck('m_c_q_practise_exam_id')->toArray();

        $practiseExam = MCQPractiseExam::whereIn('id',$examId)
            ->get();


//        $time1 = new \Nette\Utils\DateTime($practiseExam[0]->startExam);
//        $time2 = new \Nette\Utils\DateTime($practiseExam[0]->endExam);
//        $timediff = $time1->diff($time2);
//
//        dd($timediff);


//        $practiseExam = MCQPractiseExam::where('institute_id', $student_data->institute_id)
//            ->orderBy('startExam','desc')
//            ->get();

    //            dd($practiseExam);

//        dd(auth()->user()->student->isession->month->month_name);
        return view('student_theorytest.index', compact('practiseExam'));
    }

    public function test($id)
    {


        $examData = MCQPractiseExam::find($id);


        $deleteoldresult = TestPaper::where('m_c_q_practise_exam_id',$id)->get();
//            ->first();


        $time1 = new \Nette\Utils\DateTime($examData->startExam);
        $time2 = new \Nette\Utils\DateTime($examData->endExam);
        $timediff = $time1->diff($time2);

        foreach ($deleteoldresult as $del_value){
            $del_value->delete();
        }

//        $deleteoldresult->delete();

//dd($deleteoldresult);


//        dd($hour);

//        dd($examData);
        return view('student_theorytest.test', compact('examData','timediff'));
    }

    public function starttheorytest(Request $request)
    {

    //    dd($request->all());
        // check for end exam notice
//        $examEndNotice = auth()->user()->notifications;
//
////        dd($examEndNotice);
//
//        for ($i=0; $i < count($examEndNotice); $i++) {
//            if ($examEndNotice[$i]->type == "App\Notifications\ExamEnd") {
////                dd($request->exam_id);
//                if ($examEndNotice[$i]->data['exam_id'] == $request->exam_id) {
////                    dd('ll');
//                    return redirect()->route('student_mcqtest.dashboard')->with('status','Exam is Ended.');
//                }
//
//            }
//
//        }

        $data = MCQPractiseExam::where(['id' => $request->exam_id])->first();

        $time1 = new \Nette\Utils\DateTime($data->startExam);
        $time2 = new \Nette\Utils\DateTime($data->endExam);
        $timediff = $time1->diff($time2);

        $min = "";
        $hour = "";

        $min = $timediff->i;
        $hour = $timediff->h;

//        $time = $request->min;



        if ($request->test == "START TEST"){
            $time = $request->min;
        }
        else{
            $time = $request->min;
        }





//        $b [] = $time;
//
//        dd($b);


        $exam_end_date = explode(" ", $data->endExam);

        $endDateTime = explode(":", $exam_end_date[1]);

        $question = explode('"', $data->question_bank->question);

        $questionData = Practisemcq::whereIn('id',$question)->get();

        foreach ($questionData as $key => $que_value) {
//            dd($que_value->paper_ans);
            $que_value->paper_ans = TestPaper::where(['m_c_q_practise_exam_id'=>$data->id])
                ->where(['student_id' => auth()->id(),'question_id' => $que_value->id])
                ->first();
        }

//        dd($questionData);
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

//            dd($request->ans);

            $ans = (Int) $request->ans;

            if ($ans != 0) {

                $paperData = TestPaper::updateOrCreate([
                    'm_c_q_practise_exam_id'       => $data->id,
                    'student_id'    => auth()->id(),
                    'question_id'   => $request->que,
                ],
                    [
                        'answer_id'     =>  $request->ans,
                    ]);
            } else {

                $paperData = TestPaper::updateOrCreate([
                    'm_c_q_practise_exam_id'       => $data->id,
                    'student_id'    => auth()->id(),
                    'question_id'   => $request->que,
                ],
                    [
                        'ans'     =>  $request->ans,
                    ]);
            }
        }
        return view('student_theorytest.starttheorytest',compact('questionData','data','page','time','endDateTime','min','hour'));

    }

    public function resultgeneratepreview(Request $request)
    {
        $examData = MCQPractiseExam::find($request->exam);

        $institute = Institute::where('user_id',$examData->institute_id)->first();


        $answerSheetData = TestPaper::where(['m_c_q_practise_exam_id' => $examData->id,'student_id'=>auth()->id()])
            ->get();

        // calculate wright question
        $mark = 0;
        foreach ($answerSheetData as $key => $sheet_value) {

//            dd($sheet_value->question);
            if ($sheet_value->question->ans_right->id == $sheet_value->answer_id) {

                $mark += $examData->question_bank->each_mcq_mark;
            }
        }



        $data = [
            'total_mark' => $examData->question_bank->each_mcq_mark * $examData->question_bank->total_mcq_question,
            'mark_obtained' => $mark,
            'inst_logo' => $institute->inst_logo,
        ];



        $pdf = PDF::loadView("pdf.testresult",compact('examData','answerSheetData','data'));

        return $pdf->stream('testresult.pdf');


//        dd($pdf);
        // generte notice of ending exam.
//        auth()->user()->notify(new ExamEnd($examData));

//        return redirect()->route('studentuser.index12')->with("success",'Your Exam Data Saved Successfully.');

//        return $pdf->stream('result.pdf');
    }

    public function end_exam_notify (Request $request) {
        $examData = MCQPractiseExam::find($request->exam);

//        dd($examData);
//        auth()->user()->notify(new ExamEnd($examData));

            return redirect()->route('studentuser.index12')->with("success",'Your Exam Data Saved Successfully.');
    }
}