<?php

namespace App\Http\Controllers;

use App\Models\Grnumber;
use App\Models\Institute;
use Illuminate\Http\Request;

class GrnumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $grnumbers = Grnumber::Where('institute_id',auth()->id())->get();

        return view('grnumbers.index',compact('grnumbers'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $instituteData = Institute::with('user')
        ->Where('user_id',auth()->id())
        ->first();

        $institute = $instituteData->grno;

         return view('grnumbers.create',compact('institute'));
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
            'grnumber' => 'required',
        ]);

        Grnumber::create([
            'institute_id' => auth()->id(),
            'grnumber' => $data['grnumber']
        ]);

        return redirect()->route('grnumbers.index')
                    ->with('success','GR Number Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grnumber  $grnumber
     * @return \Illuminate\Http\Response
     */
    public function show(Grnumber $grnumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grnumber  $grnumber
     * @return \Illuminate\Http\Response
     */
    public function edit(Grnumber $grnumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grnumber  $grnumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grnumber $grnumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grnumber  $grnumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grnumber $grnumber)
    {
         $grnumber->delete();

        return redirect()->route('grnumbers.index')
                        ->with('success','GR Number Deleted Successfully.');
    }
}
