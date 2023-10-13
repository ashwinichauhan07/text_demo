<?php

namespace App\Http\Controllers;

use App\Models\LicensePayment;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Revenue;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $studentData = [];
        $subject_payment = [];
        $student_subject = [];


        // dd($request->all());

        $revenueData = Revenue::all();
        $instituteData = User::where('userType',2)->get();

        if (isset($request->name) && !empty($request->name)) {

            $studentData = Student::with('user')
                -> where('institute_id', $request->name)
                ->get();

            $student_id = Student::with('user')
                -> where('institute_id', $request->name)
                ->pluck('id');


            $subject_payment = LicensePayment::whereIn('student_id',$student_id)->get();

            $subject_id = LicensePayment::whereIn('student_id',$student_id)->pluck('subject_id');

            $student_subject = StudentSubject::where('student_id',3)->wherenotIn('subject_id',$subject_id)->get();


//            $sub = [];
//
//            foreach ($subject_payment as $key=> $subject_value) {
//
//                foreach ($student_subject as $key=> $sub_value) {
//
//                    $sub [] = $subject_value->subject_id == $sub_value->subject_id;
//
//                }
//            }

//            dd($sub);
//
//
//            dd($student_subject);

        }

        return view('revenue.index',compact('revenueData','instituteData','studentData','subject_payment'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
