<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Student_batch;
use App\Models\Itiming;

use App\Models\Carbon;


class AttendanceDataController extends Controller
{
    public function insert_absentdata(Request $request)
    {

        $data = [];
    	 // dd($request);

    	 $student = Student::with('installments')->where('user_id',auth()->id())->get();

        $student_data = Student::with('installments')->where('user_id',auth()->id())->first();


        foreach ($student as $key => $value) {
            $data []=  $value->student_batch;
        }

        // dd($data);

        $data_id = [];
        foreach ($data as $key => $value) {
            $data_id[] =  $value->batch_id;
        }

        $time_data = Itiming::whereIn('id',$data_id)->get();

        $current_time = date(" G:i ");



        // $start_time = [];
        foreach ($time_data as $key => $value) {


            $exlpode_time = explode(":" , $value->start_time);

            $end_time = $exlpode_time[0] += 1;

            $exlpode_current_time = explode(":" , $current_time);

            $currentTime = $exlpode_current_time[0] += 1;

             // dd($currentTime);

            $batch_time = Itiming::whereBetween('start_time' ,[$current_time, $currentTime] )
                ->where('institute_id',$student_data->institute_id)
                ->first();

            // $end_time++;

            // dd($batch_time->id);


            $time = Student_batch::where('student_id',$student_data->id)
                ->where('batch_id',$batch_time->id)->first();

             // dd($time);

        }

        // dd($batch_time->id);

        $start_date = '20'.date('y').'-'.date('m').'-'.date('d').' 00:00:00';

        $end_date = '20'.date('y').'-'.date('m').'-'.date('d').' 23:59:00';

         // dd($end_date);

        $attendance_data = Attendance::where(['student_id' => auth()->user()->student->id, 'batch_id' => $time->batch_id])->whereBetween('created_at',[$start_date, $end_date])->get();

       // dd(count($attendance_data));

        // for ($i=0; $i <= count($attendance_data)  ; $i++) {

        if (count($attendance_data) == 0) {
             // dd($attendance_data);
            auth()->user()->student->attendance()->create([
                'batch_id' => $time->batch_id,
                'd' => date('d'),
                'attendance' => "P",
            ]);
        }
        else{
                auth()->user()->student->attendance()->create([
                'batch_id' => $time->batch_id,
                'd' => date('d'),
                'attendance' => "A",
            ]);

        }
        // }

        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }

    public function insert_absentattendance(){

        $students = Student::all();

        $itimeing = Itiming::all();

        $data = [];


        $studentbatch = "";

        foreach ($students as $key => $student_value) {
            $studentbatch  = $student_value->student_batch;

            foreach ($studentbatch as $key => $studentbatch_value) {

                foreach ($itimeing as $key => $itimeing_value) {

                    if($studentbatch_value->batch_id == $itimeing_value->id){

                        $att = Attendance::where(['student_id' => $studentbatch_value->student_id,
                         'batch_id' => $studentbatch_value->batch_id,
                         'd' => date('d')
                        ])
                        ->first();

                        if($att == null){

                           $attendance = Attendance::create([
                                'batch_id' => $studentbatch_value->batch_id,
                                'd' => date('d'),
                                'attendance' => "A",
                                'student_id' => $studentbatch_value->student_id
                            ]);




                        }

                        // dd($att);
                    }


                }

            }

        }

        // dd($studentbatch);

    }



}







