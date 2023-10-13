<?php

namespace App\Http\Controllers;

use App\Models\Homekey;
use App\Models\HomeKeyResult;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class HomekeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homekeyData = Homekey::where('institute_id',auth()->id())->get();

        // dd($homekeyData);

        return view('homekey.index',compact('homekeyData'));
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

        return view('homekey.create',compact('languageData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

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

       $data = Homekey::create([
               'institute_id' => $auth_id, 
               'language_id' => $data['language_id'],
               'name' => $data['name'],
               'desc' => $data['desc'],

        ]);

        return redirect()->route('homekey.index')->with('status','Homekey Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homekey  $homekey
     * @return \Illuminate\Http\Response
     */
    public function show(Homekey $homekey)
    {
        //
    }

    public function typingpractise(Homekey $homekey)
    {
        // dd($homekey);
        return view('homekey.typingpractise',compact('homekey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homekey  $homekey
     * @return \Illuminate\Http\Response
     */
    public function edit(Homekey $homekey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Homekey  $homekey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homekey $homekey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homekey  $homekey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homekey $homekey)
    {
        $homekey->delete();

        return redirect()->route('homekey.index')->with('status','Homekey Delete Successfully.');
    }

    public function homekey_result(Request $request)
    {
        // dd($request->all());

         // $data = [];

         $result_data = HomeKeyResult::create([
               'student_id' => $request->student_id, 
               'institute_id' => $request->institute_id,
               'language_id' => $request->language_id,  
               'homekey_id' => $request->homekey_id, 
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
