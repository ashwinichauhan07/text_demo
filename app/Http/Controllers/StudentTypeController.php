<?php

namespace App\Http\Controllers;

use App\Models\StudentType;
use Illuminate\Http\Request;

class StudentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $studentType =StudentType::where('institute_id',$auth_id)->get();
        return view('studentType.index',compact('studentType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studentType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->validate([
            'name'=>'required'
        ]);

        // dd($data);

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

       $data = StudentType::create([
               'institute_id' => $auth_id, 
               'name' => $data['name'],
        ]);

        return redirect()->route('studentType.index')->with('status','Student Type Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentType  $studentType
     * @return \Illuminate\Http\Response
     */
    public function show(StudentType $studentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentType  $studentType
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentType $studentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentType  $studentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentType $studentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentType  $studentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentType $studentType)
    {
        $studentType->delete();

        return redirect()->route('studentType.index')->with('status','Student Type Delete Successfully.');
    }
}
