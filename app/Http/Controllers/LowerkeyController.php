<?php

namespace App\Http\Controllers;

use App\Models\Lowerkey;
use App\Models\Language;
use App\Models\LowerKeyResult;
use Illuminate\Http\Request;

class LowerkeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lowerkeyData = Lowerkey::where('institute_id',auth()->id())->get();
        return view('lowerkey.index',compact('lowerkeyData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }
        
        $languageData =Language::where('institute_id',$auth_id)->get();
        
        return view('lowerkey.create',compact('languageData'));
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
            'language_id' => 'required',
        ]);

        // dd($data);

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

       $data = Lowerkey::create([
               'institute_id' => $auth_id, 
               'language_id' => $data['language_id'],
               'name' => $data['name'],
               'desc' => $data['desc'],

        ]);

        return redirect()->route('lowerkey.index')->with('status','Lowerkey Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lowerkey  $lowerkey
     * @return \Illuminate\Http\Response
     */
    public function show(Lowerkey $lowerkey)
    {
        //
    }

    public function typingpractise(Lowerkey $lowerkey)
    {
        
        return view('lowerkey.typingpractise',compact('lowerkey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lowerkey  $lowerkey
     * @return \Illuminate\Http\Response
     */
    public function edit(Lowerkey $lowerkey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lowerkey  $lowerkey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lowerkey $lowerkey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lowerkey  $lowerkey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lowerkey $lowerkey)
    {
        $lowerkey->delete();

        return redirect()->route('lowerkey.index')->with('status','Lowerkey Delete Successfully.');
    }

    public function lowerkey_result(Request $request){

        // dd($request->all());
        $result_data = LowerKeyResult::create([
               'student_id' => $request->student_id, 
               'institute_id' => $request->institute_id, 
               'language_id' => $request->language_id, 
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
