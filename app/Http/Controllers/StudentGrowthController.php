<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\TypingPractise;
use App\Models\PractiseType;
use App\Models\Typing_practise_result;
use App\Models\KeboardPractice;
use App\Models\KeyboardPractiseResult;
use App\Models\Mcqtype;
use App\Models\Practisemcq;
use App\Models\PractisePaper;
use App\Models\TestPaper;
use App\Models\PractiseMCQTest;
use App\Models\MCQPractiseExam;
use App\Models\Studentinstallments;
use App\Models\StudentSession;
use App\Models\Typing_test_result;



class StudentGrowthController extends Controller
{
    	public function index(){


            if (auth()->user()->userType == 2) {

          	 	$auth_id = auth()->id();
       		 }
       		else{

            	 $auth_id = auth()->user()->instructor->institute_id;
       			}

	    $students_report = Student::with('user')->where('institute_id', $auth_id)
	    ->get();

                  // dd($students);

    	return view('studentgrowth.index',compact('students_report'));
    }


    public function viewresult($id){
    	// dd($id);
      $student = StudentSubject::where('student_id',$id)->get();
            // dd($student);

      $student_data= StudentSubject::where('student_id',$id)->pluck('subject_id');
              // dd($student_data);

      $student_id = Student::find($id);

      if (auth()->user()->userType == 2) {

        $auth_id = auth()->id();
      }
     else{

      $auth_id = auth()->user()->instructor->institute_id;
        }

         // dd($student_id->user_id);


      $subject_arr =[];
        $subjectId =[];

        foreach ($student_id->student_subject as $key=> $subject_value) {

            if ($subject_value->old == 0) {

                $subject_arr[] = $subject_value;
                $subjectId[] = $subject_value->subject_id;
            }
        }
               // dd($subject_arr);


      $practise_types = PractiseType::where('institute_id',$student_id->institute_id)
      ->whereIn('subject_id', $student_data)->get();
           // dd($practise_types);

      $keyboardType = KeboardPractice::where('institute_id',$student_id->institute_id)
        ->whereIn('subject_id',$student_data)
        ->get();

        $mcqtype= Mcqtype::where('institute_id',$auth_id)->get();

             // dd($keyboardType);

             $studentinstallment = Studentinstallments::where(['student_id' => $id, 'type' => 1])->get();

             $total_amount = 0;

             if($studentinstallment != null){
                 foreach($studentinstallment as $install_value){
                    $total_amount += $install_value->amount;
                 }
             }

            //  dd($total_amount);

            $student_session = StudentSession::where(['student_id' => $id])
            ->orderBy('batch_id', 'ASC')
            ->get();

// dd($student_session);


    	return view('studentgrowth.viewresult', compact('student','practise_types',
        'keyboardType','id','mcqtype','student_id','studentinstallment','total_amount','student_session'));

    }


      public function viewenglishresult(Request $request){
    // dd($request->all());

        // $stud_id = Typing_practise_result::where('student_id',$id)->get();
        // dd($stud_id);
// $stud = Student::all();
        // dd($stud);

         $studid = Student::where('id',$request->user_id)->first();
             // dd($studid);

         // $stud_name = User::where('id',$studid->user_id)->first();
           // dd($stud_name);

        $typingresult = Typing_practise_result::where('practise_type',$request->practise_id)->where('student_id',$studid->user_id)
        ->latest()->get();

          // dd($typingresult);

        $result_data = $typingresult->unique('typing_practise_id');

        // dd($result_data);

        // dd($result_data->typingpractise->typingdata);
              // dd($result_data);

        $practise_name = PractiseType::where('id',$request->practise_id)->first();

         // dd($practise_name->name);



        // $accuracy = 0;



            // $accuracy = ($result_data->obtmark /  $result_data->tmark)*100;

       // dd($accuracy);

       // $student_data= StudentSubject::where('student_id',$id)->pluck('subject_id');
      //               // dd("$student_data");

      // $typing_result_data = TypingPractise::where('institute_id',$student_id->institute_id)
      //       ->whereIn('subject_id',$student_data)
      //       ->get();

            // dd("$typing_result_data");

        return view('studentgrowth.viewenglishresult', compact('result_data','practise_name','studid'));
      }

      public function testresult(Request $request){

         // dd($request->all());


    $studid = Student::where('id',$request->user_id)->first();


    $typingresult = Typing_test_result::where('practise_type',$request->practise_id)->where('student_id',$studid->user_id)
    ->latest()->get();



    $result_data = $typingresult->unique('typing_practise_id');

     // dd($result_data);


    $practise_name = PractiseType::where('id',$request->practise_id)->first();



        return view('studentgrowth.testresult', compact('result_data','practise_name','studid'));


      }

      public function showtestresult(Request $request){
           // dd($request->all());

          $typingtest_result = Typing_test_result::where(['id' => $request->id, 'practise_type'=>$request->practise_type])->first();

          $practise_name = PractiseType::where('id',$request->practise_type)->first();


        //   dd($practise_name);

        //   $typingtest_result = Typing_test_result::where('student_id',auth()->id())
        //   ->whereBetween('created_at',[$previoue_date,$current_time])
        //   ->get();

          $studid = User::where('id',$request->user_id)->first();



          return view('studentgrowth.showtestresult',compact('typingtest_result','studid','practise_name'));
      }



       public function test(Request $request){
        // dd($request->all());

        $studdid = Student::where('id',$request->user_id)->first();
       // dd($studdid);

        $keyresult = KeyboardPractiseResult::where('practise_type',
          $request->practise_type_id)->where('student_id',$studdid->user_id)
          ->latest()
         ->get();

         $viewResult = $keyresult->unique('keboard_practice_id');

              // $student_data = Student::whereIn('student_id', $attendanceData)
                // ->unique('student_id');


        //   dd($viewResult);

        $practise_name = PractiseType::where('id',$request->practise_type_id)->first();
          // dd($practise_name);

         return view('studentgrowth.test', compact('viewResult','practise_name','studdid'));
       }

       public function mcq_practiseresult(Request $request){

        // dd($request->all());

        $studentuser_id = Student::find($request->user_id);

        $answerSheetData = PractisePaper::where(['mcq_type_id' =>$request->mcqtype_id, 'student_id'=>$studentuser_id->user_id])
        ->get();


        $mcqtype = Mcqtype::find($request->mcqtype_id);

        // dd($mcqtype);



        $m_w_a =  PractisePaper::where(['mcq_type_id' =>$request->mcqtype_id, 'student_id'=>$studentuser_id->user_id])
        // ->whereNull('answer_id')
        ->count();

        $total_que = Practisemcq::where('mcq_type_id',$request->mcqtype_id)
        ->count();

        $answerSheet = PractisePaper::where(['mcq_type_id' =>$request->mcqtype_id, 'student_id'=>$studentuser_id->user_id])
        ->pluck('answer_id');

        $rightans = [];

        foreach($answerSheetData as $key => $sheet_value){

           $rightans[] = $sheet_value->where('answer_id',$sheet_value->question->ans_right->id)
           ->first();

        }

        $countarr = array_filter($rightans);

        $count = count($countarr);


        $accuracy = 0;

        if($total_que != null){

            $accuracy = ($count /  $total_que)*100;

        }


        return view('studentgrowth.mcq_practiseresult',compact('answerSheetData', 'mcqtype','m_w_a','total_que',
        'accuracy','studentuser_id'));

}

       public function accuracyresult(Request $request)
       {
               // dd($request->all());


         

  
        $typingpractise_result = Typing_practise_result::where(['id'=>$request->id, 
          'practise_type'=>$request->practise_type])->first();
                 // dd($typingpractise_result);


        $studName = User::where('id', $request->student_id)->first();
         // dd($studName);


        $practise_name = PractiseType::where('id',$request->practise_type)->first();

         // dd($practise_name->name);








        // $total_marks = Typing_practise_result::where('tmark',
        //   $typingpractise_result->tmark)->first();
          // dd($total_marks);


        return view('studentgrowth.accuracyresult', compact('typingpractise_result', 'studName', 'practise_name'));

       }

       public function mcq_testresult(Request $request){

        $studentuser_id = Student::find($request->user_id);

        $mcqtype = Mcqtype::find($request->mcqtype_id);


        $Questionpaper = PractiseMCQTest::where(['level' =>$request->mcqtype_id])
        ->pluck('id');

        if($Questionpaper != null){

            $mcqtestexam_id = MCQPractiseExam::whereIn('question_bank_no',$Questionpaper)
            ->pluck('id');

            $mcqtestexam = MCQPractiseExam::whereIn('question_bank_no',$Questionpaper)
            ->get();


            $answerSheetData = TestPaper::whereIn('m_c_q_practise_exam_id',$mcqtestexam_id)
            ->where('student_id',$studentuser_id->user_id)
            ->get();


        }

        // dd($answerSheetData);


        foreach ($mcqtestexam as $key => $exam_value) {

            $resultData = $this->mcqtest_result([
                'exam_id' => $exam_value->id,
                'student_id' => $studentuser_id->user_id,
            ]);


            $exam_value->totalmark = $resultData['total_mark'];
            $exam_value->mark_obtain = $resultData['markobtain'];

            // dd($exam_value);

            // $students_value->unpaidfees = $feesData['unpaid_fess'];
            // $students_value->revenue = $feesData['revenue'];
        }


        return view('studentgrowth.mcq_testresult',compact('mcqtestexam', 'mcqtype','studentuser_id'));


    }


    public function mcqtest_result($id)
    {
        // dd($id['exam_id']);

        $data = array();

        $examData = MCQPractiseExam::where('id',$id['exam_id'])
        ->first();

        $total_mark = $examData->question_bank->total_mcq_question * $examData->question_bank->each_mcq_mark;

        $answerSheetData = TestPaper::where(['m_c_q_practise_exam_id' => $id['exam_id'],'student_id'=>$id['student_id']])
        ->get();

        $mark = 0;


        foreach ($answerSheetData as $key => $sheet_value) {

            if($sheet_value->question->ans_right->id == $sheet_value->answer_id){
                 $mark += 1;
            }
        }

        $markobtain = $mark *  $examData->question_bank->each_mcq_mark;


        // <p>Total Mark Obtained :- <i id="ma_obtained">{{ $mark *  $examData->question_bank->each_mcq_mark }}</i></p>


    $data['total_mark'] =  $total_mark;
    $data['markobtain'] =  $markobtain;

    return $data;

    // dd($data['total_mark']);

    // $userData['unpaid_fess'] =  $unpaid_amount - $paid_amount;
     // $userData['revenue'] =  $revenue;

    }



}
