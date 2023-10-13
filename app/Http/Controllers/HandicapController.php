<?php

namespace App\Http\Controllers;

use App\Models\Handicap;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HandicapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $handicapData = Handicap::all();

        return view('handicap.index',compact('handicapData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('handicap.create');
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
            'name'=>'required|unique:handicaps',
        ]);

        Handicap::create($request->all());

        return redirect()->route('handicap.index')->with('status','Handicap Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Handicap  $handicap
     * @return \Illuminate\Http\Response
     */
    public function show(Handicap $handicap)
    {
          return view('handicap.show',compact('handicap'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Handicap  $handicap
     * @return \Illuminate\Http\Response
     */
    public function edit(Handicap $handicap)
    {
        return view('handicap.edit',compact('handicap'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Handicap  $handicap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Handicap $handicap)
    {
        dd('jtt');
        
        $validate = request()->validate([
            'name'=>['required',Rule::unique('handicaps')->ignore($handicap->name,'name'),]
        ]);

        $handicap->update($request->all());

        return redirect()->route('handicap.index')->with('status','Handicap Update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Handicap  $handicap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handicap $handicap)
    {
        $handicap->delete();
        
        return redirect()->route('handicap.index')->with('status','Handicap Delete Successfully.');
    }
}
