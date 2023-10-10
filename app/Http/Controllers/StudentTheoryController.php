<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use App\Models\PractiseExam;
use App\Models\Practisemcq;
use App\Models\PractisePaper;
use App\Models\PractiseStudent;
use App\Models\Student;
use App\Models\Mcqtype;

use Illuminate\Http\Request;

class StudentTheoryController extends Controller
{
    public function studenttheory()
    {
        $student_data = Student::where('user_id', auth()->id())->first();

        // $practiseExam = PractiseExam::where('institute_id', $student_data->institute_id)->get();

        $data = Practisemcq::pluck('mcq_type_id');

        // dd($data);
        $practiseExam = Mcqtype::where('institute_id', $student_data->institute_id)
        ->whereIn('id', $data)
        ->get();

            //   dd($practiseExam);
//        dd(auth()->user()->student->isession->month->month_name);
        return view('studenttheory.index', compact('practiseExam'));
    }

    public function test($id)
    {

//        $examId = PractiseStudent::where('practise_exam_id',$id)->first();


        // $examData = PractiseExam::find($id);


        $examData = Mcqtype::find($id);



//            ->first();

    //    dd($examData);
       return view('studenttheory.test',compact('examData'));
    }

//     public function starttest(Request $request)
//     {
//         // check for end exam notice
//         $test_data = $request->submit;
// //        dd($request->all());


//         $answer_id = $request->ans;
//         $pageno = $request->page;

//         $data = PractiseExam::where(['id' => $request->exam_id])->first();

//         $question = explode('"', $data->question_bank->question);

//         $questionData = Practisemcq::whereIn('id',$question)
//         ->get();

//          // $question = explode('"', $data->question_bank->question);

//         //  $questionData = Practisemcq::where('mcq_type_id',$request->exam_id)
//         //  ->get();

// //                dd($data->name);


//         foreach ($questionData as $key => $que_value) {
// //dd($que_value->paper_ans);
//             $que_value->paper_ans = PractisePaper::where(['practise_exam_id'=>$data->id])
//                 ->where(['student_id' => auth()->id(),'question_id' => $que_value->id])
//                 ->first();
//         }

//         $page = 0;

// //        dd($request->all());
// //
// //        dd($request->page);

//         if (isset($request->page) && !empty($request->page)) {
//             $page = (Int) $request->page - 1;
//         }
// //        dd('ll');

//         // if next btn is pressed
//         if (isset($request->next) && !empty($request->next)) {
//             $page++;

// //            dd($page);
//         }

//         // if next btn is pressed
//         if (isset($request->previous) && !empty($request->previous)) {
//             $page = $page - 1;
//         }

//         // if isset answer
//         if ($request->submit == "SUBMIT" || $request->next == "NEXT") {
// //            dd('ll');
//             if (isset($request->que) && !empty($request->que) && isset($request->ans)) {

//                 $ans = (int)$request->ans;

//                 if ($ans != 0) {

//                     $paperData = PractisePaper::updateOrCreate([
//                         'practise_exam_id' => $data->id,
//                         'student_id' => auth()->id(),
//                         'question_id' => $request->que,
//                     ],
//                         [
//                             'answer_id' => $request->ans,
//                         ]);
//                 } else {

//                     $paperData = PractisePaper::updateOrCreate([
//                         'practise_exam_id' => $data->id,
//                         'student_id' => auth()->id(),
//                         'question_id' => $request->que,
//                     ],
//                         [
//                             'ans' => $request->ans,
//                         ]);
//                 }

//             }
//         }
//         $wrightans = "";

//         $answerSheetData = PractisePaper::where(['practise_exam_id' => $data->id,'student_id'=>auth()->id()])
//             ->where('question_id',$request->que)
//             ->first();

//         if ($answerSheetData != null){
//             $wrightans = $answerSheetData->question->ans_right;
//         }

// //      dd($wrightans);

// //        $mark = 0;
// //        foreach ($answerSheetData as $key => $sheet_value) {
// //            if ($sheet_value->question->ans_right->id == $sheet_value->answer_id) {
// //                $mark += $examData->question_bank->each_mcq_mark;
// //            }
// //        }
// //
// //        $data = [
// //            'total_mark' => $examData->question_bank->each_mcq_mark * $examData->question_bank->total_mcq_question,
// //            'mark_obtained' => $mark,
// //        ];


//         return view('studenttheory.starttest',compact('questionData','test_data','page','wrightans','answerSheetData',
//             'answer_id', 'pageno','data'));
//     }

    public function starttest(Request $request)
    {
        
    
        // check for end exam notice
        $test_data = $request->submit;
    //    dd($request->all());


        $answer_id = $request->ans;
        $pageno = $request->page;
        $lan = $request->lan;


        $data = Practisemcq::where(['mcq_type_id' => $request->exam_id])->first();

//  dd($data);
        // $question = explode('"', $data->question_bank->question);

        // $questionData = Practisemcq::whereIn('id',$question)
        // ->get();

         // $question = explode('"', $data->question_bank->question);
        //  $questionData = Practisemcq::where('file_path',$request->file_path)
        //  ->get();
            // dd($request->file_path);

         $questionData = Practisemcq::where('mcq_type_id',$request->exam_id)
         ->get();

            //    dd($request->exam_id);


        foreach ($questionData as $key => $que_value) {
//dd($que_value->paper_ans);
            $que_value->paper_ans = PractisePaper::where(['mcq_type_id'=>$request->exam_id])
                ->where(['student_id' => auth()->id(),'question_id' => $que_value->id])
                ->first();
        }

        // dd($que_value);
        $page = 0;

//        dd($request->all());
//
//        dd($request->page);


        if (isset($request->page) && !empty($request->page)) {
            $page = (Int) $request->page - 1;
        }
//        dd('ll');

        // if next btn is pressed
        if (isset($request->next) && !empty($request->next)) {
            $page++;

//            dd($page);
        }

        // if next btn is pressed
        if (isset($request->previous) && !empty($request->previous)) {
            $page = $page - 1;
        }

        // if isset answer
        if ($request->submit == "SUBMIT") {
//            dd('ll');
            if (isset($request->que) && !empty($request->que) && isset($request->ans)) {

                $ans = (int)$request->ans;

                if ($ans != 0) {

                    $paperData = PractisePaper::updateOrCreate([
                        'mcq_type_id' => $request->exam_id,
                        'student_id' => auth()->id(),
                        'question_id' => $request->que, // Make sure $request->que contains a valid question ID
                    ],
                    [
                        'answer_id' => $request->ans,
                    ]);
                    
                } else {

                    $paperData = PractisePaper::updateOrCreate([
                        'mcq_type_id' => $request->exam_id,
                        'student_id' => auth()->id(),
                        'question_id' => $request->que,
                    ],
                        [
                            'ans' => $request->ans,
                        ]);
                }

            }
        }
           // Retrieve the selected language from the request
    $selectedLanguage = $request->input('language');
      // Assuming you have a variable named $selectedLanguage that holds the selected language value
$selectedLanguage = $selectedLanguage;

// Assign the appropriate language based on the selected language value
if ($selectedLanguage === 'marathi') {
    $language = 'Marathi';
} elseif ($selectedLanguage === 'english') {
    $language = 'English';
} elseif ($selectedLanguage === 'hindi') {
    $language = 'Hindi';
} else {
    // Default to English if no valid language is selected
    $language = 'English';
}
        
        $wrightans = "";

        $answerSheetData = PractisePaper::where(['mcq_type_id' => $request->exam_id,'student_id'=>auth()->id()])
            ->where('question_id',$request->que)
            ->first();

        if ($answerSheetData != null){
            $wrightans = $answerSheetData->question->ans_right;
        }

//      dd($wrightans);

//        $mark = 0;
//        foreach ($answerSheetData as $key => $sheet_value) {
//            if ($sheet_value->question->ans_right->id == $sheet_value->answer_id) {
//                $mark += $examData->question_bank->each_mcq_mark;
//            }
//        }
//
//        $data = [
//            'total_mark' => $examData->question_bank->each_mcq_mark * $examData->question_bank->total_mcq_question,
//            'mark_obtained' => $mark,
//        ];
// Assuming you have a variable $language that stores the selected language value
// $selectedLanguage = $language;




        return view('studenttheory.starttest',compact('selectedLanguage','questionData','test_data','data','page','wrightans','answerSheetData',
            'answer_id', 'pageno','lan',));
    }

     public function mcqresult(Request $request){
        // dd($request->all());
}
}
