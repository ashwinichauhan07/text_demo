<?php

namespace App\Http\Controllers;

use App\Models\StudentInfo;
use App\Models\Studentinstallments;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Models\Student_course;
use App\Models\StudentSubject;
use App\Models\Student_batch;
use App\Models\Institute;
use Illuminate\Http\Request;
use PDF;

class StudentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    
    public function index()
    {
     $studentInfo = Studentinstallments::onlyTrashed()->get();
         // dd($studentInfo);
     $studentname = "";

      if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

            // dd($auth_id);

         $students = Student::onlyTrashed()->where("institute_id", $auth_id)->get();
         // dd($students);

 // $course = $userData->student->student_course
 //        ->unique('course_id');

         $courses = Student_course::onlyTrashed()->get();

         // dd($courses);

         $student_subject = StudentSubject::onlyTrashed()->get();
            // dd($student_subject);


     // $students = Student::with('user')->Where("institute_id", $auth_id)->get();

            foreach ($students as $key => $students_value) {

             $feesData = $this->feesDetail($students_value->user_id);

             $students_value->totalfees = $feesData['fess'];
             $students_value->paidfees = $feesData['paid_fess'];
             $students_value->unpaidfees = $feesData['unpaid_fess'];
             // $students_value->revenue = $feesData['revenue'];

             // $studentname = User::where('id',$students_value->user_id)->first();

                          // dd($studentname);


             // $students_value->name = $studentname->name;


         }

         // dd($students);




        return view('studentinfo.index', compact('studentInfo','students','courses','student_subject'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }


     public function feesDetail($id)
    {


        $data = array();



        $userData = User::onlyTrashed()->with('student')->find($id);



        $student = Student::onlyTrashed()->where('user_id', $userData->id)->first();

     

        // dd($course);


        if (!is_null($userData)) {

            // fees details
    $total = Studentinstallments::onlyTrashed()->where('student_id',$student->id)
                    ->where(['type' => 2])
                    ->get();

                 // dd($total);

    $total_amount = 0;
    foreach ($total as $key => $total_value) {
        $total_amount += $total_value->amount;
    }


    $paid = Studentinstallments::onlyTrashed()->where(['student_id' => $student->id])
                    ->where(['type' => 1])->get();

    $paid_amount = 0;
    foreach ($paid as $key => $paid_value) {
        $paid_amount += $paid_value->amount;
    }


    $unpaid = Studentinstallments::onlyTrashed()->where(['student_id' => $student->id])
                    ->where(['type' => 2])->get();



    $unpaid_amount = 0;
    foreach ($unpaid as $key => $unpaid_value) {
        $unpaid_amount += $unpaid_value->amount;
    }
                                                 // dd($unpaid_amount);



    //  $total_amount = Studentinstallments::Where("institute_id", auth()->id())
    //   ->where(['type' => 2])->get();

    // $revenue = 0;
    // foreach ($total_amount as $key => $total_value) {
    //     $revenue += $total_value->amount;
    // }

    // dd($total);

    $userData['fess'] =  $total_amount;
    $userData['paid_fess'] =  $paid_amount;
    $userData['unpaid_fess'] =  $unpaid_amount - $paid_amount;
     // $userData['revenue'] =  $revenue;

            return $userData;
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\StudentInfo  $studentInfo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Studentinstallments::onlyTrashed()->where('student_id', $id)
        ->where(['type' => 1])
        ->get();

     // dd($data);
        
        return view('studentinfo.showinstallmentrecipt', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentInfo  $studentInfo
     * @return \Illuminate\Http\Response
     */
    public function printreceipt($id)
    {

      // dd($id);

    $studentinstallment = Studentinstallments::onlyTrashed()->where('id', $id)->first();
     // dd($studentinstallment);
    $student = Student::onlyTrashed()->where('id', $studentinstallment->student_id)
    ->first();

      // dd($student->lastname);    

    $courses = Student_course::onlyTrashed()->get();


    // dd($courses);

    $paid_amount = $studentinstallment->amount;

    // dd($paid_amount);
    $mode = $studentinstallment->mode;
    // dd($mode);

    $total = Studentinstallments::onlyTrashed()->where(['student_id' => $studentinstallment->student_id])->where(['type' => 2])->get();

        // dd($total);

    $total_amount = 0;
    // dd($total_amount);
    foreach($total as $key => $total_value)
    {
        $total_amount += $total_value->amount;
    }

      // dd($total_amount);

     if (auth()->user()->userType == 2) {

                   $auth_id = auth()->id();
                }
                else{

                    $auth_id = auth()->user()->instructor->institute_id;
                }

    $institute_logo = Institute::where('user_id',$auth_id)->first();

    // dd($institute_logo);
    $inst_logo = $institute_logo->inst_logo;
    // dd($inst_logo);

    $institute =Institute::where('user_id',$auth_id)->first();
    // dd($institute);

    $address = $institute->address;

   
    $studenData = User::onlyTrashed()->where('id',$student->user_id)->first();


       // dd($studenData);
     $rs =$studentinstallment::onlyTrashed()->where('student_id',$studentinstallment->student_id)
             ->where('type',1)
             ->get();

           // dd($rs);


          if($rs != null){
            $p = 0;
            foreach($rs as $key =>$total_value)
            {
                $p += $total_value->amount;
            }
          }   
                      // dd($p);


     $fees = $total_amount - $p;

     // dd($fees);
    $paid = Studentinstallments::onlyTrashed()->where(['student_id' => $studentinstallment->student_id])
             ->where(['type' => 1])
             ->get();

             // dd($paid);

     $total_paid_amount = 0;
     foreach($paid as $key => $paid_value)
     {
        $total_paid_amount += $paid_value->amount;
     }
         
         // dd($total_paid_amount); 

    $student = Student::onlyTrashed()->with('student_subject')->where('id',
        $studentinstallment->student_id)->first(); 
           // dd($student); 

    $subject = StudentSubject::onlyTrashed()->where('student_id', $student->id)
    ->pluck('subject_id');
                   // dd($subject); 

    $studSubject = Subject::whereIn('id', $subject)->get();
                   // dd($studSubject); 

    $subjectData = [];
    // dd($subjectData);

    foreach($studSubject as $key => $subject_value )
    {

          // dd($subject_value);
        $subjectData[] = $subject_value->name;
    }
       // dd($subjectData);

    $subject = implode(' , ', $subjectData);

    $studenData['father_name'] = $student->father_name;
    $studenData['lastname'] = $student->lastname;
    $studenData['receipt_no'] = $studentinstallment->id;
    $studenData['date'] = $studentinstallment->installment_date;
    $studenData['inst_logo'] =  $inst_logo;
    $studenData['add'] =  $address;
    $studenData['sub'] =  $subject;
    $studenData['student_type'] =  1;
    $studenData['paid_amount'] =  $studentinstallment->totalpaid_amount;
    $studenData['mode'] =  $mode;
    $studenData['total_amount'] = $total_amount;
    $studenData['unpaid_amount'] = $studentinstallment->balance_amount;
    $studenData['paid_value'] = $paid_amount;
    $studenData['next_installmentate'] =  $studentinstallment->next_installmentdate;

    // dd($studentinstallment->id);

     $data = [
            'data' => $studenData
        ];

         // dd($data);

    $pdf = PDF::loadView('pdf.printreceipt', $data);

    return $pdf->stream('printreceipt.pdf');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentInfo  $studentInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentInfo $studentInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentInfo  $studentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);

        

        $studentBatch = Student_batch::onlyTrashed()->where('student_id', $id)
        ->get();

         // dd($studentBatch);

        foreach($studentBatch as $key => $studentBatch_value){

            $studentBatch_value->forceDelete();
            }

        $studentCourse = Student_course::onlyTrashed()->where('student_id', $id)
        ->get();

        // dd($studentCourse);

         foreach($studentCourse as $key => $studentCourse_value){

            $studentCourse_value->forceDelete();
            }



         $studentSubject = StudentSubject::onlyTrashed()
        ->where('student_id', $id)->get();

          // dd($studentSubject);

         foreach($studentSubject as $key => $studentSubject_value){

             $studentSubject_value->forceDelete();
            }


        $studentInstallment = Studentinstallments::onlyTrashed()
        ->where('student_id', $id)->get();

        // dd($studentInstallment);

        foreach($studentinstallment as $key => $studentInstallment_value)
        {
            $studentInstallment_value->forceDelete();
        }


        $studentDeleted = Student::onlyTrashed()->where('id', $id)->first();

          // dd($studentDeleted->id);

         $studentDeleted->forceDelete();

        $userDeleted = User::onlyTrashed()->where('id', $studentDeleted->user_id)
        ->first();
        // dd($userDeleted);

         $userDeleted->forceDelete();

       
        

         return redirect()->route('studentinfo.index')
                        ->with('success','Student Installment Information Deleted Successfully.');
     
    }


     public function restore($id)
    {

        // dd($id);
        $restoreStudentBatch = Student_batch::onlyTrashed()
        ->where('student_id', $id)->get();
           // dd($restoreStudentBatch);
     foreach($restoreStudentBatch as $key => $restoreStudentBatch_value){

        if($restoreStudentBatch_value && $restoreStudentBatch_value->trashed())
            {
                $restoreStudentBatch_value->restore();
            }
        }



        $restoreStudentSubject = StudentSubject::onlyTrashed()
        ->where('student_id', $id)->get();
        // dd($restoreStudentBatch);
     foreach($restoreStudentSubject as $key => $restoreStudentSubject_value){

        if($restoreStudentSubject_value && $restoreStudentSubject_value->trashed())
            {
                $restoreStudentSubject_value->restore();
            }

        }



        $restoreStudentCourse = Student_course::onlyTrashed()
        ->where('student_id', $id)->get();
        // dd($restoreStudentBatch);
     foreach($restoreStudentCourse as $key => $restoreStudentCourse_value){

        if($restoreStudentCourse_value && $restoreStudentCourse_value->trashed())
            {
                $restoreStudentCourse_value->restore();
            }

        }

    $studentInstallment = Studentinstallments::onlyTrashed()
    ->where('student_id', $id)->get();
        // dd($studentInstallment);
     foreach($studentInstallment as $key => $studentInstallment_value){

        if($studentInstallment_value && $studentInstallment_value->trashed())
            {
                $studentInstallment_value->restore();
            }
        
        }


        $restoreDataId = Student::onlyTrashed()->where('id', $id)->first();

        // dd($restoreDataId);

        if($restoreDataId && $restoreDataId->trashed()){
           $restoreDataId->restore();
        }


         $restoreUser = User::onlyTrashed()->where('id', $restoreDataId->user_id)
         ->first();
      // dd($restoreUser);

         if($restoreUser && $restoreUser->trashed()){
           $restoreUser->restore();
        }


       


     

        return redirect()->route('studentinfo.index')->with('message','Data restored successfully');
    }
}
