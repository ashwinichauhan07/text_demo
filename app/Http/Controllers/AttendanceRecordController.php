<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Student;
use App\Models\Institute;
use App\Models\Itiming;
use Illuminate\Support\Facades\Validator;
use DB;


class AttendanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      
        return view ('attendancerecord.index',compact('attendanceData','itimings','studentData','start_date','end_date','student_data','day'));
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
     * @param  \App\Models\AttendanceRecord  $attendanceRecord
     * @return \Illuminate\Http\Response
     */
    public function show(AttendanceRecord $attendanceRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttendanceRecord  $attendanceRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendanceRecord $attendanceRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttendanceRecord  $attendanceRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttendanceRecord $attendanceRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendanceRecord  $attendanceRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendanceRecord $attendanceRecord)
    {
        //
    }
}
