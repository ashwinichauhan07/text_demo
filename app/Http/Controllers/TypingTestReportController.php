<?php

namespace App\Http\Controllers;

use App\Models\TypingTestReport;
use App\Models\Student;
use App\Models\Typing_test_result;
use Illuminate\Http\Request;

class TypingTestReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
         // dd($student);

        $typingTest = Typing_test_result::where('student_id', $student)->first();


          // dd($typingTest);

        return view('typingtestreport.index', compact('student', 'typingTest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexofmcq()
    {
        $student = Student::all();
        // dd($student);

        return view('typingtestreport.indexofmcq', compact('student'));
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
     * @param  \App\Models\TypingTestReport  $typingTestReport
     * @return \Illuminate\Http\Response
     */
    public function show(TypingTestReport $typingTestReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypingTestReport  $typingTestReport
     * @return \Illuminate\Http\Response
     */
    public function edit(TypingTestReport $typingTestReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypingTestReport  $typingTestReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypingTestReport $typingTestReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypingTestReport  $typingTestReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypingTestReport $typingTestReport)
    {
        //
    }
}
