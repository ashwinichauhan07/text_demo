<?php

namespace App\Http\Controllers;

use App\Models\Mcqtest;
use App\Models\Mcqtype;
use App\Models\Subject;
use Illuminate\Http\Request;

class McqtestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mcqtestData = Mcqtest::all();

        if (auth()->user()->userType !=1) {
            $mcqtest_id = [];
              foreach ($mcqtestData as $key => $mcqtest_value) 
              {
                if ($mcqtest_value->institute_id != auth()->id()) 
                {
                    unset($mcqtestData[$key]);
                }   
                else {
                  $mcqtest_id[] = $mcqtest_value->id;
              } 
            }
         }

         // dd(auth()->user());

        return view('mcqtest.index',compact('mcqtestData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mcqtypeData = Mcqtype::all();
        $subjectData = Subject::all();
        // dd($subjectData);
        return view('mcqtest.create',compact('mcqtypeData','subjectData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = request()->validate([
            'subject_id'=>'required',
            'mcqtype_id'=>'required',
            'timer'=>'required',
            'que_mark'=>'required',
            'criteria'=>'required',
            'test_date'=>'required',
        ]);
        // dd($userData);

        $userData = Mcqtest::create([
            'institute_id'  => auth()->id(),
            'subject_id'    => $userData['subject_id'],
            'mcqtype_id'    => $userData['mcqtype_id'],
            'timer'         => $userData['timer'],
            'que_mark'      => $userData['que_mark'],
            'criteria'      => $userData['criteria'],
            'test_date'     => $userData['test_date'],
        ]);

        return redirect()->route('mcqtest.index')->with('status','MCQ Test Created Successfully');
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
