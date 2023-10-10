<?php

namespace App\Http\Controllers;

use App\Models\Hallticket;
use Illuminate\Http\Request;
use App\Models\ExamBatches;
use App\Models\User;
use App\Models\Student;
use App\Models\Institute;
use Illuminate\Support\Facades\Validator;
use PDF;

class HallticketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // For Institute and Instructor creation
        if (auth()->user()->userType == 2) {

          $auth_id = auth()->id();
        }
        else {

          $auth_id = auth()->user()->instructor->institute_id;
        }


        $hallticketData = Hallticket::where('institute_id',$auth_id)->get();
  
        return view ('hallticket.index',compact('hallticketData'));
    }

     public function hallticket_time_table(Hallticket $hallticket){


          if (auth()->user()->userType == 2) {

              $auth_id = auth()->id();
            }
            else {

              $auth_id = auth()->user()->instructor->institute_id;
            }

           $hallticketData = Hallticket::where('institute_id',$auth_id)->get();

           // $studentData = Student::with('user')->where('id', $hallticket->student_id)->first();

           //  $hallticketData['studentData'] = $studentData;

           $data = [
            'data' => $hallticketData,
        ];

          $pdf = PDF::loadView('pdf.hallticket_time_table',$data);

          return $pdf->download('hallticket_time_table.pdf');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      if (auth()->user()->userType == 2) {
          $auth_id = auth()->id();
      }
      else {
        $auth_id = auth()->user()->instructor->institute_id;
      }
        
       $ExamBatcheData = ExamBatches::where('institute_id',$auth_id)->get();
       
       return view ('hallticket.create', compact('ExamBatcheData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'exam_date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'day'=>'required',
            'batch'=>'required',
            // 'center_name'=>'required',
            'subject_id' => 'required',
        ]);

        $studenData = User::where('id',$request->user_id)->first();

        // dd($request->all());

        if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }

         $studenData->student->hallticket()->create([
             'institute_id' => $auth_id, 
              'exam_date' => $validate['exam_date'],
              'start_time' => $validate['start_time'],
              'end_time' => $validate['end_time'],
              'day' => $validate['day'],
              'subject_id' => $validate['subject_id'],
              'batch' => $validate['batch'],
              // 'center_name' => $validate['center_name']

         ]);

        // $data = [
        //     'data' => $studenData,
        // ];

        // dd($data);

        // $pdf = PDF::loadView('pdf.hallticket',$data);

        // return $pdf->download('hallticket.pdf');

       return redirect()->route('hallticket.index')->with('success','Hall icket Created.');
    }

    public function hallticket_print(Hallticket $hallticket){


      $studentData = Student::with('user')->where('id', $hallticket->student_id)->first();

      $student_grno = Student::with('student_grno')->where('id', $hallticket->student_id)->first();

      $instituteData = Institute::where('user_id',$hallticket->institute_id)->first();

      // dd($instituteData);

      foreach ($student_grno->student_grno as $key => $studentgr_value) {
               $grno = $studentgr_value;
      }


            if (auth()->user()->userType == 2) {

               $auth_id = auth()->id();
            }
            else{

                $auth_id = auth()->user()->instructor->institute_id;
            }


        $institute_logo = Institute::where('user_id',$auth_id)->first();

        // dd($institute_logo->inst_logo);
       $inst_logo = $institute_logo->inst_logo;

      // dd($grno);
         
         $hallticket['studentData'] = $studentData;
         $hallticket['grno'] = $grno;
         $hallticket['instituteData'] = $instituteData;
         $hallticket['inst_logo'] = $inst_logo;
         
         $data = [
            'data' => $hallticket,
            // 'data' => $studentData,
         ];

        // dd($data);

        $pdf = PDF::loadView('pdf.hallticket',$data);

        return $pdf->download('hallticket.pdf');

    }

     public function batchfilter(Request $request)
    {
       $data =[];

       $validate = Validator::make($request->all(),[
          'batch_id' => 'required',
      ]);

      // dd($validate->validated()['batch_id']);
      // dd($validate->fails());

      if ($validate->fails()) {
          $message = "";
          foreach ($validate->errors()->all() as $key => $error_value) {
               $message .= $error_value. '|';
          }

           return response()->json([
                'status' => false,
                'message' => $message,
                'data' => $data,
            ]);
       }

       // For Institute and Instructor creation
        if (auth()->user()->userType == 2) {

          $auth_id = auth()->id();
        }
        else {

          $auth_id = auth()->user()->instructor->institute_id;
        }

       // dd($validate->validated()['student_type']);
        
          $exam_date = ExamBatches::where('batch_number',$validate->validated()['batch_id'])
         ->Where("institute_id", $auth_id)
         ->first();

         // return($exam_date->exam_date);

        return response()->json([
                'status' => true,
                'message' => "exam_date list",
                'data' => $exam_date,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hallticket  $hallticket
     * @return \Illuminate\Http\Response
     */
    public function show(Hallticket $hallticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hallticket  $hallticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Hallticket $hallticket)
    {

         $ExamBatcheData = ExamBatches::where('institute_id',auth()->id())->get();

        return view ('hallticket.edit',compact('ExamBatcheData','hallticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hallticket  $hallticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hallticket $hallticket)
    {
         $validate = request()->validate([
            'exam_date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'day'=>'required',
            'batch'=>'required',
            // 'center_name'=>'required',
            'subject_id' => 'required',
        ]);

        $studenData = User::where('id',$request->user_id)->first();

        // dd($request->all());

         $hallticket->fill([
             'institute_id' => auth()->id(), 
              'exam_date' => $validate['exam_date'],
              'start_time' => $validate['start_time'],
              'end_time' => $validate['end_time'],
              'day' => $validate['day'],
              'subject_id' => $validate['subject_id'],
              'batch' => $validate['batch'],
              // 'center_name' => $validate['center_name']

         ])->update();


        return redirect()->route('hallticket.index')->with('success','Hall icket Created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hallticket  $hallticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hallticket $hallticket)
    {
         $hallticket->delete();
        
        return redirect()->route('hallticket.index')->with('status','Hall Ticket Delete Successfully.');
    }



    
}
