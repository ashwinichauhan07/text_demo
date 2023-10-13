<?php

namespace App\Http\Controllers;

use App\Models\Mcqtype;
use Illuminate\Http\Request;

class McqtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mcqtypeData = Mcqtype::all();


        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }
    

        if (auth()->user()->userType !=1) {
            $mcqtype_id = [];
              foreach ($mcqtypeData as $key => $mcqtype_value) 
              {
                if ($mcqtype_value->institute_id != $auth_id) 
                {
                    unset($mcqtypeData[$key]);
                }   
                else {
                  $mcqtype_id[] = $mcqtype_value->id;
              } 
            }
         }
        return view('mcqtype.index',compact('mcqtypeData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mcqtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = $request->validate([
            'name'=>'required',
        ]);


        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $userData = Mcqtype::create([
            'institute_id' => $auth_id,
            'name' => $userData['name'],
        ]);

        //Mcqtype::create($request->all());

    return redirect()->route('mcqtype.index')->with('status','MCQ Type is Created.');

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
    public function destroy(Mcqtype $mcqtype)
    {
        $mcqtype->delete();
        
        return redirect()->route('mcqtype.index')->with('status','MCQ Type Delete Successfully.');
    }
}
