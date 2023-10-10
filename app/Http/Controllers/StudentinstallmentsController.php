<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studentinstallments;
use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\StudentType;
use App\Models\Subject;
use App\Models\Isession;
use App\Models\Institute;
use PDF;
use DB;

class StudentinstallmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $studentinstallmentData = Studentinstallments::all();

        // $students = Student::with('user')->get();

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }


         $students = Student::with('user')->Where("institute_id", $auth_id)->get();

         // $students = $student_data->unique('course_id');




          // $revenue = DB::table('studentinstallments')
          //       ->select(DB::raw('SUM(amount)'))
          //       ->where(['type' => 2])
          //       ->get();

          //        $explode = explode(',', $revenue);
          //        $explode = explode('[', $explode[0]);
          //        $explode = explode(']', $explode[1]);
          //        $explode = explode('{"SUM(amount)":', $explode[0]);
          //        $explode = explode('}', $explode[1]);

          //     $total_revenue =   implode("", $explode);


              $total_amount = Studentinstallments::Where("institute_id", auth()->id())
              ->where(['type' => 1])
              ->get();

          // dd($total_amount);

            $revenue = 0;
            foreach ($total_amount as $key => $total_value) {
                $revenue += $total_value->amount;
            }


   // dd($revenue);

         foreach ($students as $key => $students_value) {

             $feesData = $this->feesDetail($students_value->user_id);

            //  dd($feesData);

             $students_value->totalfees = $feesData['fess'];
             $students_value->paidfees = $feesData['paid_fess'];
             $students_value->unpaidfees = $feesData['unpaid_fess'];
             // $students_value->revenue = $feesData['revenue'];
         }

          // dd($students);
// dd($students_value->totalfees);


          // dd($total_revenue);


        // dd(auth()->user()->institute->installments);
         // if (auth()->user()->userType != 1) {
         //    $student_id = [];

         //    foreach ($studentinstallmentData as $key => $stu_value) {

       //          if ($stu_value->institute_id != auth()->id()) {
       //         unset($studentinstallmentData[$key]);

       //        } else{
       //           $feesData = $this->feesDetail($stu_value->student_id);

       //           dd
       //        }
       //      }
       // }


        return view('studentinstallments.index', compact('students','studentinstallmentData','revenue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $studentType =StudentType::where('institute_id',$auth_id)->get();
        $isessions = Isession::all();
        return view('studentinstallments.create',compact('studentType'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
// dd($request->next_installmentdate);
        $validate = request()->validate([
            'name' => 'required',
            'amount_paid' => 'required',
            'payment_mode' => 'required',
        ]);

        $insatllmentDate = date("d-m-Y", strtotime($request->installment_date));

        if($request->next_installmentdate != null){

            $nextinsatllmentDate = date("d-m-Y", strtotime($request->next_installmentdate));
        }
        else{
            $nextinsatllmentDate = $request->next_installmentdate;

        }

        // $nextinsatllmentDate = $request->next_installmentdate;

// dd($nextinsatllmentDate);

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $current_data = date("m", strtotime($request->installment_date));

//        dd($current_data);
       $studenData = User::where('id',$request->user_id)->first();

     // dd($studenData);

        if ($request->payment_mode == 1) {
           $studenData->student->installments()->create([
            'institute_id' => $auth_id,
            'created_id'  => auth()->id(),
            'amount'    =>  $request->amount_paid,
            'mode'      =>  $request->payment_mode,
            'type'      =>  1,
            'next_installmentdate' => $nextinsatllmentDate,
                'currentmonth' => $current_data,
                'installment_date'=>$insatllmentDate,
            ]);

        } elseif ($request->payment_mode == 2) {

            $chec = request()->validate([
                'cheque_no' =>   'required',
                'check_date'  =>   'required',
            ]);

            $studenData->student->installments()->create([
            'institute_id' =>$auth_id,
            'created_id'  => auth()->id(),
            'amount'    =>  $request->amount_paid,
            'mode'      =>  $request->payment_mode,
            'type'      =>  1,
            'check_number'  => $request->cheque_no,
            'check_date'   => $request->check_date,
            'next_installmentdate' => $nextinsatllmentDate,
            'installment_date'=>$insatllmentDate,
                'currentmonth' => $current_data,
            ]);

        }

        elseif ($request->payment_mode == 3) {

            $chec = request()->validate([
                'transaction_id' =>   'required',
            ]);
// dd($request->transaction_id);

            $studenData->student->installments()->create([
            'institute_id' =>$auth_id,
            'created_id'  => auth()->id(),
            'amount'    =>  $request->amount_paid,
            'mode'      =>  $request->payment_mode,
            'type'      =>  1,
            'transaction_id'  => $request->transaction_id,
            'next_installmentdate' => $nextinsatllmentDate,
            'installment_date'=>$insatllmentDate,
                'currentmonth' => $current_data,
            ]);

        }


        $studenData->student->update(['currentmonth' => $current_data]);

     // dd($studentData);

        // $date = Studentinstallments::where(['type' => 1])->first();

         $date =  DB::table('studentinstallments')->latest('created_at')
         ->where(['type' => 1])->first();

         $stud_id =  DB::table('studentinstallments')->latest('id')
         ->where(['type' => 1])->first();

         $mode = $request->payment_mode;

        $receipt_date = $date->installment_date;

        $receipt_no = $stud_id->id;


        // dd($receipt_no);

          $userData =User::where('id',$request->user_id)->first();


        if (!is_null($userData)) {

            $userData->student->course;
            $userData->student->subject;

            // fees details
    $total = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 2])
                    ->get();

    $total_amount = 0;
    foreach ($total as $key => $total_value) {
        $total_amount += $total_value->amount;
    }

    $paid = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 1])
                    ->get();

            $padifees = Studentinstallments::where(['student_id' => $userData->student->id])
                ->where(['type' => 1])
                ->latest()
                ->first();

//            dd($padifees);

//dd($padifees);
    $paid_amount = 0;
    foreach ($paid as $key => $paid_value) {
        $paid_amount += $paid_value->amount;
    }

    // dd($paid_amount);


    $unpaid = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 2])->get();

    $unpaid_amount = 0;
    foreach ($unpaid as $key => $unpaid_value) {
        $unpaid_amount += $unpaid_value->amount;
    }
}

        $course = $userData->student->student_course
        ->unique('course_id');

        $courseData =[];

         foreach ($course as $key => $course_value) {

            $courseData[] = $course_value->course->name;
        }

        $course_data = implode(',', $courseData);


        // $studenType = StudentType::whereIn('')

        // $student_id = Studentinstallments::where()

        $student = Student::with('student_subject')->where('user_id',$request->user_id)->first();

           // dd($student);

        $subjectData =[];
    // dd($subjectData);

         foreach ($student->student_subject as $key => $subject_value) {

            $subjectData[] = $subject_value->subject->name;
        }

     // dd($subjectData);

        $subject = implode(' , ', $subjectData);

        $institute_logo = Institute::where('user_id',$auth_id)->first();

        // dd($institute_logo->inst_logo);
       $inst_logo = $institute_logo->inst_logo;

       $institute =Institute::where('user_id',$auth_id)->first();

         $address = $institute->address;

         $lastinsatllment = Studentinstallments::latest()->first();

//dd($lastinsatllment);
        $lastinsatllment->update([
            'totalpaid_amount' => $paid_amount,
            'balance_amount' => $total_amount - $paid_amount,
        ]);

       $studenData->student->installments()->

    $studenData['total_amount'] = $total_amount;
    $studenData['paid_amount'] = $paid_amount;
    $studenData['unpaid_amount'] = $total_amount - $paid_amount;
    $studenData['add'] =  $address;
    $studenData['sub'] =  $subject;
    $studenData['course'] =  $course_data;
    $studenData['date'] =  $receipt_date;
    $studenData['mode'] =  $mode;
    $studenData['student_type'] = 1;
    $studenData['receipt_no'] = $receipt_no;
    $studenData['paid_value'] = $padifees->amount;
    $studenData['inst_logo'] =  $inst_logo;
    $studenData['next_installmentate'] =  $lastinsatllment->next_installmentdate;


    $data = [
            'data' => $studenData,
        ];
//
//        dd($data);


        $pdf = PDF::loadView('pdf.installment',$data);



        return $pdf->stream('installment.pdf');

        return redirect()->route('studentinstallments.index')->with('status','Installment Created.');


    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function show($id)
    {

        $data = Studentinstallments::where('student_id', $id)
        ->where(['type' => 1])
        ->get();
        // dd($data);

        // $data_arr = [];
        // foreach ($data as $key => $data_value) {
        //      $data_arr[] = $data_value->type;
        // }

        // dd($data_arr)

        return view('studentinstallments.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function receipt(Studentinstallments $studentinstallment)
    {

       // dd($studentinstallment);
        $course = $studentinstallment->student->student_course
        ->unique('course_id');



        $courseData =[];

         foreach ($course as $key => $course_value) {

            $courseData[] = $course_value->course->name;
        }

        $course_data = implode(',', $courseData);


     // $studenType = $studentinstallment->studenttype->name;

        $paid_amount = $studentinstallment->amount;

       // dd($paid_amount);

        $mode = $studentinstallment->mode;
        // dd($mode);

        $total = Studentinstallments::where(['student_id' => $studentinstallment->student->id])
                    ->where(['type' => 2])
                    ->get();
       // dd($total);
           $total_amount = 0;
           // dd($total_amount);
         foreach ($total as $key => $total_value) {

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

         $inst_logo = $institute_logo->inst_logo;

         $institute =Institute::where('user_id',$auth_id)->first();

         $address = $institute->address;

         $studenData = User::where('id',$studentinstallment->student->user_id)->first();
         // dd($studenData);
         $rs =$studentinstallment::where('student_id',$studentinstallment->student_id)
             ->where('type',1)
             ->get();

              // dd($rs);

         if ($rs != null){
              $p =0;
             foreach ($rs as $key => $total_value) {
                 $p += $total_value->amount;
             }
         }
         $fees = $total_amount - $p;


         $paid = Studentinstallments::where(['student_id' => $studentinstallment->student_id])
             ->where(['type' => 1])
             ->get();

//dd($paid);
         $paid_total_amount = 0;
         foreach ($paid as $key => $paid_value) {
             $paid_total_amount += $paid_value->amount;
         }

         $student = Student::with('student_subject')->where('id',$studentinstallment->student_id)->first();

          // dd($student);

         $subjectData =[];

         foreach ($student->student_subject as $key => $subject_value) {

            // dd($subject_value->subject);
             $subjectData[] = $subject_value->subject->name;
         }

         // dd($subjectData);

         $subject = implode(' , ', $subjectData);



    $studenData['receipt_no'] = $studentinstallment->id;
    $studenData['inst_logo'] =  $inst_logo;
    $studenData['add'] =  $address;
    $studenData['date'] =  $studentinstallment->installment_date;
    $studenData['course'] =  $course_data;
    $studenData['student_type'] =  1;
    $studenData['paid_amount'] =  $studentinstallment->totalpaid_amount;
    $studenData['mode'] =  $mode;
    $studenData['sub'] =  $subject;
    $studenData['total_amount'] = $total_amount;
    $studenData['unpaid_amount'] = $studentinstallment->balance_amount;
    $studenData['paid_value'] = $paid_amount;
    $studenData['next_installmentate'] =  $studentinstallment->next_installmentdate;

    $data = [
            'data' => $studenData,
        ];
//
                // dd($data);


       $pdf = PDF::loadView('pdf.installment',$data);

        return $pdf->stream('installment.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Studentinstallments $studentinstallment)
    {
    //   dd($studentinstallment);

    if (auth()->user()->userType == 2) {

        $auth_id = auth()->id();
     }
     else{

         $auth_id = auth()->user()->instructor->institute_id;
     }

     $insatlldate = date("Y-m-d", strtotime($studentinstallment->installment_date));

    //  dd($insatlldate);


     $studentType =StudentType::where('institute_id',$auth_id)->get();
     $isessions = Isession::all();

    return view('studentinstallments.edit',compact('studentType','isessions','studentinstallment','insatlldate'));


    }

    public function update(Request $request, Studentinstallments $studentinstallment)
    {
        // dd($studentinstallment);

        $validate = request()->validate([
            'name' => 'required',
            'amount_paid' => 'required',
            'payment_mode' => 'required',
        ]);

        $insatllmentDate = date("d-m-Y", strtotime($request->installment_date));

        if($request->next_installmentdate != null){

            $nextinsatllmentDate = date("d-m-Y", strtotime($request->next_installmentdate));
        }
        else{
            $nextinsatllmentDate = $request->next_installmentdate;

        }

        // $nextinsatllmentDate = $request->next_installmentdate;

// dd($nextinsatllmentDate);

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $current_data = date("m", strtotime($request->installment_date));

//        dd($current_data);
       $studenData = User::where('id',$request->user_id)->first();

     // dd($studenData);

        if ($request->payment_mode == 1) {

            $studentinstallment->fill([
            'institute_id' => $auth_id,
            'created_id'  => auth()->id(),
            'amount'    =>  $request->amount_paid,
            'mode'      =>  $request->payment_mode,
            'type'      =>  1,
            'next_installmentdate' => $nextinsatllmentDate,
                'currentmonth' => $current_data,
                'installment_date'=>$insatllmentDate,
            ])->update();

        } elseif ($request->payment_mode == 2) {

            $chec = request()->validate([
                'cheque_no' =>   'required',
                'check_date'  =>   'required',
            ]);

            $studentinstallment->fill([
            'institute_id' =>$auth_id,
            'created_id'  => auth()->id(),
            'amount'    =>  $request->amount_paid,
            'mode'      =>  $request->payment_mode,
            'type'      =>  1,
            'check_number'  => $request->cheque_no,
            'check_date'   => $request->check_date,
            'next_installmentdate' => $nextinsatllmentDate,
            'installment_date'=>$insatllmentDate,
                'currentmonth' => $current_data,
            ])->update();

        }

        elseif ($request->payment_mode == 3) {

            $chec = request()->validate([
                'transaction_id' =>   'required',
            ]);
// dd($request->transaction_id);

           $studentinstallment->fill([
            'institute_id' =>$auth_id,
            'created_id'  => auth()->id(),
            'amount'    =>  $request->amount_paid,
            'mode'      =>  $request->payment_mode,
            'type'      =>  1,
            'transaction_id'  => $request->transaction_id,
            'next_installmentdate' => $nextinsatllmentDate,
            'installment_date'=>$insatllmentDate,
                'currentmonth' => $current_data,
            ])->update();

        }


        $studentinstallment->update(['currentmonth' => $current_data]);

     // dd($studentData);

        // $date = Studentinstallments::where(['type' => 1])->first();

         $date =  DB::table('studentinstallments')->latest('created_at')
         ->where(['type' => 1])->first();

         $stud_id =  DB::table('studentinstallments')->latest('id')
         ->where(['type' => 1])->first();

         $mode = $request->payment_mode;

        $receipt_date = $date->installment_date;

        $receipt_no = $stud_id->id;


        // dd($receipt_no);

          $userData =User::where('id',$request->user_id)->first();


        if (!is_null($userData)) {

            $userData->student->course;
            $userData->student->subject;

            // fees details
    $total = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 2])
                    ->get();

    $total_amount = 0;
    foreach ($total as $key => $total_value) {
        $total_amount += $total_value->amount;
    }

    $paid = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 1])
                    ->get();

            $padifees = Studentinstallments::where(['student_id' => $userData->student->id])
                ->where(['type' => 1])
                ->latest()
                ->first();

//            dd($padifees);

//dd($padifees);
    $paid_amount = 0;
    foreach ($paid as $key => $paid_value) {
        $paid_amount += $paid_value->amount;
    }

    // dd($paid_amount);


    $unpaid = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 2])->get();

    $unpaid_amount = 0;
    foreach ($unpaid as $key => $unpaid_value) {
        $unpaid_amount += $unpaid_value->amount;
    }
}

        $course = $userData->student->student_course
        ->unique('course_id');

        $courseData =[];

         foreach ($course as $key => $course_value) {

            $courseData[] = $course_value->course->name;
        }

        $course_data = implode(',', $courseData);


        // $studenType = StudentType::whereIn('')

        // $student_id = Studentinstallments::where()

        $student = Student::with('student_subject')->where('user_id',$request->user_id)->first();

           // dd($student);

        $subjectData =[];
    // dd($subjectData);

         foreach ($student->student_subject as $key => $subject_value) {

            $subjectData[] = $subject_value->subject->name;
        }

     // dd($subjectData);

        $subject = implode(' , ', $subjectData);

        $institute_logo = Institute::where('user_id',$auth_id)->first();

        // dd($institute_logo->inst_logo);
       $inst_logo = $institute_logo->inst_logo;

       $institute =Institute::where('user_id',$auth_id)->first();

         $address = $institute->address;

         $lastinsatllment = Studentinstallments::latest()->first();

//dd($lastinsatllment);
        $lastinsatllment->update([
            'totalpaid_amount' => $paid_amount,
            'balance_amount' => $total_amount - $paid_amount,
        ]);

//        $studenData->student->installments()->([

    $studenData['total_amount'] = $total_amount;
    $studenData['paid_amount'] = $paid_amount;
    $studenData['unpaid_amount'] = $total_amount - $paid_amount;
    $studenData['add'] =  $address;
    $studenData['sub'] =  $subject;
    $studenData['course'] =  $course_data;
    $studenData['date'] =  $receipt_date;
    $studenData['mode'] =  $mode;
    $studenData['student_type'] = 1;
    $studenData['receipt_no'] = $receipt_no;
    $studenData['paid_value'] = $padifees->amount;
    $studenData['inst_logo'] =  $inst_logo;
    $studenData['next_installmentate'] =  $lastinsatllment->next_installmentdate;


    $data = [
            'data' => $studenData,
        ];
//
//        dd($data);


        $pdf = PDF::loadView('pdf.installment',$data);



        return $pdf->stream('installment.pdf');

        return redirect()->route('studentinstallments.index')->with('status','Installment Created.');
    }


     public function session(Request $request)
    {
        $isessions = Isession::all();
        $students  = Student::all();
        $total_amount = 0;
        $total_paid_amount = 0;
        $total_balance_amount = 0;




        // dd($request->year);

        $studentData = [];
        $installmentData = [];

        if (isset($request->isession_id) && !empty($request->isession_id) && isset($request->year) && !empty($request->year)) {

            $studentData = Student::where(['isession_id'=>$request->isession_id,'year'=>$request->year])
            ->Where("institute_id", auth()->id())
            ->get();
            // ->pluck('id');
            // $installmentData = Studentinstallments::whereIn('student_id',$studentData)->get();

            foreach ($studentData as $key => $students_value) {

             $feesData = $this->feesDetail($students_value->user_id);

             $students_value->totalfees = $feesData['fess'];
             $students_value->paidfees = $feesData['paid_fess'];
             $students_value->unpaidfees = $feesData['unpaid_fess'];
             // $students_value->revenue = $feesData['revenue'];

         }


            foreach ($studentData as $key => $total_value) {
                $total_amount += $total_value->totalfees;
            }

            foreach ($studentData as $key => $total_value) {
                $total_paid_amount += $total_value->paidfees;
            }

            foreach ($studentData as $key => $total_value) {
                $total_balance_amount += $total_value->unpaidfees;
            }

            // dd($total_amount);


        }

        return view('studentinstallments.session',compact('isessions','students','installmentData','studentData','total_amount','total_paid_amount','total_balance_amount'));
    }


    public function revenue(Request $request)
    {


        $insatllmentDate = date("d-m-Y", strtotime($request->installment_date));

        // $date = date('Y-m-d').' 00:00:00';

          $students  = Student::all();

        //   newfromdate

          $newfromdate = date("d-m-Y", strtotime($request->fromdate));

          $newtodate = date("d-m-Y", strtotime($request->todate));

          $frommonth = date("m", strtotime($request->fromdate));


          $tomonth = date("m", strtotime($request->todate));

        //   dd(date("m", strtotime($request->todate)));
        //   installment_date

        // $studentinstallment = Studentinstallments::where('institute_id', auth()->id())
        // ->where(['type' => 1])
        // ->get();

        $studentData = [];

        // foreach ($studentinstallment as $key => $studentinstallment_value) {
        //       $studentData [] = $studentinstallment_value->created_at;
        // }

          if (isset($newfromdate) && !empty($newfromdate) && isset($newtodate) && !empty($newtodate)) {

            //

            $studentData = Studentinstallments::with('student')
            ->whereBetween('currentmonth', [$frommonth, $tomonth])
           ->Where("institute_id", auth()->id())
           ->where(['type' => 1])
           ->get();

        //    $studentData = Studentinstallments::with('student')->whereBetween('installment_date',["01-04-2022", "30-04-2022"])
        //    ->Where("institute_id", auth()->id())
        //    ->where(['type' => 1])
        //    ->get();

//             $uniques = array();
// foreach ($countries as $c) {
//     $uniques[$c->code] = $c; // Get unique country by code.
// }

            $data =[];

             foreach ($studentData as $key => $value) {

                // dd($value-student_id);

                $feesData = $this->feesDetail($value->student->user_id);

                //  $feesData = $this->feesDetail($value->student_id);
                 $value->totalfees = $feesData['fess'];
                 $value->paidfees = $feesData['paid_fess'];
                 $value->unpaidfees = $feesData['unpaid_fess'];
             }
             // dd($data);

        //     foreach ($data as $key => $students_value) {
        //      $feesData = $this->feesDetail($students_value->user_id);
        //      $students_value->totalfees = $feesData['fess'];
        //      $students_value->paidfees = $feesData['paid_fess'];
        //      $students_value->unpaidfees = $feesData['unpaid_fess'];
        //      // $students_value->revenue = $feesData['revenue'];
        //  }

            $revenue = 0;
            foreach ($studentData as $key => $total_value) {
                $revenue += $total_value->amount;
            }
          }

        //   $studentData['data'] =  $data;
        //   $user_value['paid_fess'] =  $paid_amount;

        //  dd($studentData);
        return view('studentinstallments.revenue',compact('students','data','revenue','studentData'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentinstallments $studentinstallment)
    {

        // dd($studentinstallment);

        $studentinstallment->delete();

        return back()->with('success','Student installment Deleted Successfully.');
        // ->with('success','Student Deleted Successfully.');
        // return redirect()->route('studentinstallments.index')
        // ->with('success','Student Deleted Successfully.');
    }

    public function feesDetail($id)
    {


        $data = array();

        $userData = User::with('student')->find($id);

// dd($id);

        if (!is_null($userData)) {

            // fees details
    $total = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 2])
                    ->get();

    $total_amount = 0;
    foreach ($total as $key => $total_value) {
        (int)$total_amount += (int)$total_value->amount;
    }

                     // dd($total);

    $paid = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 1])->get();

    $paid_amount = 0;
    foreach ($paid as $key => $paid_value) {
        $paid_amount += $paid_value->amount;
    }

    $unpaid = Studentinstallments::where(['student_id' => $userData->student->id])
                    ->where(['type' => 2])->get();

    $unpaid_amount = 0;
    foreach ($unpaid as $key => $unpaid_value) {
       (int)$unpaid_amount += (int)$unpaid_value->amount;
    }


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

    public function findattendance(Request $request)
    {

        // dd($request->itiming_id);
        $studentData = [];

        $attendanceData = Student::with('attendance')->where('institute_id', auth()->id())->get();

        $attendance_arr = [];

        foreach ($attendanceData as $key => $attendance_value) {

           $attendance_arr [] = $attendance_value->id;
        }

         $attendance = Attendance::whereIn('student_id', $attendance_arr)->get();

         $attendance_data = [];


         foreach ($attendance as $key => $attendance_value) {

           $attendance_data [] = $attendance_value->created_at;
        }


        $newfromdate = $request->fromdate." 00:00:00";

        $newtodate = $request->todate." 23:59:00";

        // dd($newfromdate);

        if (isset($newfromdate) && !empty($newfromdate) && isset($newtodate) && !empty($newtodate)  && isset($request->itiming_id) && !empty($request->itiming_id)) {

             $month = explode(" ", $newfromdate);
             $month = explode("-", $month[0]);
             if($month[0] != null){

              $month = explode(" ", $month[1]);



             $data =   Attendance::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"),DB::raw("DATE(created_at) as date"))
             // ->where('created_at', '>', Carbon::today()->subDay(6))
             ->groupBy('day_name','day','date')
             ->orderBy('day','ASC')
             ->whereBetween('created_at',[$newfromdate, $newtodate])
             ->get();

             // dd($data);

             $days = [];

             foreach ($data as $key => $value) {
             $days [] = $value->day;
              }

             $studentData = Attendance::with('student')->whereBetween('created_at',[$newfromdate, $newtodate])
              ->whereIn('student_id', $attendance_arr)
              ->where('batch_id', $request->itiming_id)
              ->select('student_id', \DB::raw("COUNT(*) as count"),\DB::raw("DAYNAME(created_at) as day_name"),\DB::raw("DAY(created_at) as day"),\DB::raw("DATE(created_at) as date"))
              ->groupBy('student_id','day_name','day','date')
              ->get();

             $student = Attendance::with('student')->whereBetween('created_at',[$newfromdate, $newtodate])
             ->whereIn('student_id', $attendance_arr)
             ->where('batch_id', $request->itiming_id)
             ->select('student_id')
             ->groupBy('student_id')
             ->get();

             $student_data = $studentData->unique('student_id');

         $student_data->values()->all();


               // dd($student);

         }

 $day = "";
switch ($month[0]) {

  case 1:
    $day = "Jan";
    break;
  case 2:
    $day = "Feb";
    break;
  case 3:
    $day = "Mar";
    break;
  case 4:
    $day = "Apr";
    break;
  case 5:
    $day = "May";
    break;
  case  6:
    $day = "Jun";
    break;
  case 7:
    $day = "Jul";
    break;
  case 8:
    $day = "Aug";
    break;
  case 9:
    $day = "Sep";
    break;
  case  10:
    $day = "Oct";
  case 11:
    $day = "Nov";
    break;
  case  12:
    $day = "Dec";
}



$start_date = explode(" ", $newfromdate);
$start_date = explode("-", $start_date[0]);

 if($start_date[0] != null){

     $start_date = explode(" ", $start_date[2]);
}

$end_date = explode(" ", $newtodate);
$end_date = explode("-", $end_date[0]);

 if($end_date[0] != null){

     $end_date = explode(" ", $end_date[2]);
}
// dd($start_date[0]);

// for ($i = $start_date; $i < $end_date; $i++) {

//     $dd =$i;
//     dd($dd);
// }

// for ($x = 0; $x <= 10; $x++) {
//   echo "The number is: $x <br>" ;
// }

        if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }

             $itimings = Itiming::where('institute_id',$auth_id)->get();

             // dd($itimings);


         return view ('attendance.findattendance',compact('attendanceData','student_data','data','day','start_date','end_date','days','itimings','student'));
}




    }




    public function getDeletedStudentInfo()
    {

        $studentinstallment = Studentinstallments::where('student_id',$student->id)
        ->get();
        $studentInfo = Studentinstallments::onlyTrashed()->get();
             // dd($studentInfo);

        // $studentInfo = Studentinstallments::onlyTrashed()->paginate(10);
             // dd($studentInfo);
            return view('studentinfo.index', compact('studentInfo',
                'studentinstallment'))
            ->with('i', (request()->input('page', 1) - 1) * 10);

    }


      public function restoreDeletedProjects($id)
    {

        $project = Project::where('id', $id)->withTrashed()->first();

        $project->restore();

        return redirect()->route('projects.index')
            ->with('success', 'You successfully restored the project');
    }


}
