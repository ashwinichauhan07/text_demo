<?php

namespace App\Http\Controllers;

use App\Models\Upperkey;
use App\Models\UpperKeyResult;
use App\Models\Language;
use Illuminate\Http\Request;

class UpperkeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upperkeyData = Upperkey::where('institute_id',auth()->id())->get();

        // dd($upperkeyData->language->name);

        return view('upperkey.index',compact('upperkeyData'));
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

        return view('upperkey.create',compact('languageData'));
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

       $data = Upperkey::create([
               'institute_id' => $auth_id, 
               'language_id' => $data['language_id'],
               'name' => $data['name'],
               'desc' => $data['desc'],

        ]);

        return redirect()->route('upperkey.index')->with('status','Upperkey Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Upperkey  $upperkey
     * @return \Illuminate\Http\Response
     */
    public function show(Upperkey $upperkey)
    {
        //
    }

    public function typingpractise(Upperkey $upperkey)
    {
        
        return view('upperkey.typingpractise',compact('upperkey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Upperkey  $upperkey
     * @return \Illuminate\Http\Response
     */
    public function edit(Upperkey $upperkey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Upperkey  $upperkey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upperkey $upperkey)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Upperkey  $upperkey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Upperkey $upperkey)
    {
        $upperkey->delete();

        return redirect()->route('upperkey.index')->with('status','Upperkey Delete Successfully.');
    }

     public function upperkey_result(Request $request)
    {
        // dd($request->language_id);

        $result_data = UpperKeyResult::create([
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
