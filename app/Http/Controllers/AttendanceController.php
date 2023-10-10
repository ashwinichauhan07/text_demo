<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Institute;
use App\Models\Itiming;
use App\Models\Student_batch;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\Validator;
use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $attendanceData = Attendance::all();

        // dd($request->all());


        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $itimings = Itiming::where('institute_id',$auth_id)->get();
        // dd($itimings);

        $student_data = [];
        $start_date = [];
        $end_date = [];

        $current_date = [];
        $stud = [];

        $studentData =[];
        $day ="";

        $attendanceData = Student::with('attendance')->where('institute_id', auth()->id())->get()->pluck('id');

        // dd($attendanceData);

        $attendance = Attendance::where('batch_id',$request->itiming_id)->whereIn('student_id', $attendanceData)->get()->pluck('created_at');

        // dd($attendance);

        // $attendance_data = [];


        //  foreach ($attendance as $key => $attendance_value) {

        //    $attendance_data [] = $attendance_value->created_at;
        // }

        $newfromdate = $request->fromdate." 00:00:00";

        $newtodate = $request->todate." 23:59:00";

        // dd($newtodate);

        $start_date = [date('Y')];

        // dd($start_date);

        $end_date = [date('y')];

    // dd($end_date);


        if (isset($newfromdate) && !empty($newfromdate) && isset($newtodate) && !empty($newtodate)  && isset($request->itiming_id) && !empty($request->itiming_id)) {

            $month = explode(" ", $newfromdate);
            // dd($month);

            $month = explode("-", $month[0]);
         // dd($month);

            if ($month[0] != null) {

                $month = explode(" ", $month[1]);
                 // dd($month);

                $data = Attendance::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"), DB::raw("DATE(created_at) as date"))
                    // ->where('created_at', '>', Carbon::today()->subDay(6))
                    ->groupBy('day_name', 'day', 'date')
                    ->orderBy('day', 'ASC')
                    ->whereBetween('created_at', [$newfromdate, $newtodate])
                    ->get();

                $days = [];
                foreach ($data as $key => $value) {
                    $days [] = $value->day;
                }

                // dd($days);
                $stud = Student_batch::where('batch_id', $request->itiming_id)->pluck('student_id');


                $studentData = Student::whereIn('id', $stud)
                    ->get();


                //  dd($newtodate);

                if ($studentData != null) {


                    $student_data = Attendance::with('student')->whereBetween('created_at', [$newfromdate, $newtodate])
                        ->whereIn('student_id', $stud)
                        ->where('batch_id', $request->itiming_id)
                        ->orderBy('d', 'ASC')
                        ->get();

                    // dd($student_data);
                }

                // $student_data = Student::whereIn('student_id', $attendanceData)
                // ->unique('student_id');


                //        dd($student_data);


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
                        break;
                    case 11:
                        $day = "Nov";
                        break;
                    case  12:
                        $day = "Dec";
                }
            }
            $start_date = explode(" ", $newfromdate);
            $start_date = explode("-", $start_date[0]);

            if ($start_date[0] != null) {

                $start_date = explode(" ", $start_date[2]);
            }
            // dd($start_date[]);
            $current_date = explode(" ", $newtodate);
            $current_date = explode("-", $current_date[0]);

            if ($current_date[0] != null) {

                $current_date = explode(" ", $current_date[2]);
            }

            // dd($current_date);

            $end_date = explode(" ", $newtodate);
            $end_date = explode("-", $end_date[0]);

            if ($end_date[0] != null) {

                $end_date = explode(" ", $end_date[2]);
            }

            if (auth()->user()->userType == 2) {

                $auth_id = auth()->id();
            } else {

                $auth_id = auth()->user()->instructor->institute_id;
            }
//            $itimings = Itiming::where('institute_id', $auth_id)->get();
            // dd($attendance_data);
        }



        return view ('attendance.index',compact('attendanceData','itimings','studentData','start_date','end_date','student_data','day','stud'));

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

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}








