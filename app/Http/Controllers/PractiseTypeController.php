<?php

namespace App\Http\Controllers;

use App\Models\PractiseType;
use App\Models\KeboardPractice;
use App\Models\PractisTypeName;
use App\Models\Subject;
use Illuminate\Http\Request;

class PractiseTypeController extends Controller
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

        $practiseType=PractiseType::where('institute_id',$auth_id)->get();

        return view('practiseType.index',compact('practiseType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $course_arr =[];

        foreach (auth()->user()->institute->institutecourse as $key=> $course_value) {

            $course_arr[] = $course_value->course->id;

        }

        // dd($course_arr);

        $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        $practiseTypename = PractisTypeName::all();

        return view('practiseType.create',compact('subjectData','practiseTypename'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd($request->all());

      $data = $request->validate([
//            'name'=>'required',
            'practise_type' => 'required',
            'subject_id' => 'required',
        ]);



        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }


        if ($request->practise_type == 0)
        {

            $practisedata = PractiseType::where(['name' => $request->practisetype_id, 'practise_type'=> $request->practise_type,
                'subject_id' => $request->subject_id, 'institute_id' => $auth_id])->first();

//            dd($practisedata);

            if ($practisedata != null){

                return redirect()->back()->with('error','This data is allready Exist');
            }
//
            $data = PractiseType::create([
                'institute_id' => $auth_id,
                'name' => $request->practisetype_id,
                'practise_type' => $data['practise_type'],
                'subject_id' => $data['subject_id'],
            ]);
        }
        else if ($request->practise_type == 1){

            $practisedata = PractiseType::where(['name' => $request->practise_id, 'practise_type'=> $request->practise_type,
                'subject_id' => $request->subject_id, 'institute_id' => $auth_id])->first();

            if ($practisedata != null){

                return redirect()->back()->with('error','This data is allready Exist');
            }
            $data = PractiseType::create([
                'institute_id' => $auth_id,
                'name' => $request->practise_id,
                'practise_type' => $data['practise_type'],
                'subject_id' => $data['subject_id'],
            ]);
        }



        return redirect()->route('practiseType.index')->with('status','Practice Type Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PractiseType  $practiseType
     * @return \Illuminate\Http\Response
     */
    public function show(PractiseType $practiseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PractiseType  $practiseType
     * @return \Illuminate\Http\Response
     */
    public function edit(PractiseType $practiseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PractiseType  $practiseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PractiseType $practiseType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PractiseType  $practiseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PractiseType $practiseType)
    {
        $practiseType->delete();

        return redirect()->route('practiseType.index')->with('status','Practice Type Delete Successfully.');
    }
}
