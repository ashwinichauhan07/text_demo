<?php

namespace App\Http\Controllers;

use App\Models\ExamName;
use Illuminate\Http\Request;

class ExamNameController extends Controller
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
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $ExamData = ExamName::where('institute_id',$auth_id)->get();

        return view('exam_name.index', compact('ExamData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('exam_name.create');

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
            'name'=>'required',
        ]);

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        // ExamName::create($request->all());

        $data = ExamName::create([
            'institute_id' => $auth_id,
            'name' => $validate['name'],
     ]);


        return redirect()->route('exam_name.index')->with('status','Exam Name Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamName  $examName
     * @return \Illuminate\Http\Response
     */
    public function show(ExamName $examName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamName  $examName
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamName $examName)
    {
        
        return view('exam_name.edit', compact('examName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamName  $examName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamName $examName)
    {
        $data = $request->validate([
            'name'=>'required',

        ]);

        $examName->fill([

            'name' => $data['name'],

        ])->update();


        return redirect()->route('exam_name.index')
                    ->with('status','Exam Name Updated Successfully.');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamName  $examName
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamName $examName)
    {
        // dd($examName);

         $examName->delete();

         return back()->with('exam_status', 'ExamName deleted successfully.');
    }
}
