<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Itiming;
use App\Models\Coursefee;
use App\Models\Isession;
use App\Models\StudentSubject;
use App\Models\student_course;



class StudentreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

         $students = Student::with('user')->where('institute_id', $auth_id)
         ->get();
         

        $isessions = Isession::all();

        // $isessions = Isession::all();
        // $students  = Student::all();

        // dd($request->year);

        $studentData = [];
        $installmentData = [];

        if (isset($request->isession_id) && !empty($request->isession_id) && isset($request->year) && !empty($request->year)) {
            
            $students = Student::where(['isession_id'=>$request->isession_id,'year'=>$request->year])
            ->Where("institute_id", auth()->id())
            ->get();


         }

         $student_subject =StudentSubject::where('institute_id',$auth_id)
         ->where('old',0)
         ->get(); 

        

        return view('studentreport.index',compact('students','isessions','student_subject'));
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
