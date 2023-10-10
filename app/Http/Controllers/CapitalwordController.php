<?php

namespace App\Http\Controllers;

use App\Models\Capitalword;
use Illuminate\Http\Request;
use App\Models\CapitalWordResult;


class CapitalwordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capitalwordData = Capitalword::where('institute_id',auth()->id())->get();

        return view('capitalword.index',compact('capitalwordData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('capitalword.create');
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
            'name'=>'required',
            'desc'=>'required',
        ]);

        // dd($data);

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

       $data = Capitalword::create([
               'institute_id' => $auth_id, 
               'name' => $data['name'],
               'desc' => $data['desc'],

        ]);

        return redirect()->route('capitalword.index')->with('status','Capital Word Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capitalword  $capitalword
     * @return \Illuminate\Http\Response
     */
    public function show(Capitalword $capitalword)
    {
        //
    }

    public function typingpractise(Capitalword $capitalword)
    {
        
        return view('capitalword.typingpractise',compact('capitalword'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Capitalword  $capitalword
     * @return \Illuminate\Http\Response
     */
    public function edit(Capitalword $capitalword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Capitalword  $capitalword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capitalword $capitalword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capitalword  $capitalword
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capitalword $capitalword)
    {
        $capitalword->delete();

        return redirect()->route('capitalword.index')->with('status','Capital Word Delete Successfully.');
    }

    public function capitalword_result(Request $request)
    {
         // dd($request->language_id);

         

        $result_data = CapitalWordResult::create([
               'student_id' => $request->student_id, 
               'institute_id' => $request->institute_id, 
               'speed' => $request->speed, 
               'wordsCount' => $request->wordsCount, 
               'correctWords' => $request->correctWords, 
               'time' => $request->time, 
               'acc' => $request->accuracy

         ]);

        // dd($result_data);

         return response()->json(
             [
               'success' => true,
               'message' => 'Result inserted successfully',
               'data' => $result_data,
             ]
        );

}
}