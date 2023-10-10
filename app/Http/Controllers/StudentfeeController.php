<?php

namespace App\Http\Controllers;

use App\Models\Studentfee;
use Illuminate\Http\Request;

class StudentfeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $studentfees = Studentfee::latest()->paginate(5);

        return view('studentfees.index',compact('studentfees'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studentfees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'mode' => 'required',
            'payment_mode'  => 'required',
        ]);

        Studentfee::create($request->all());

        return redirect()->route('studentfees.index')
                    ->with('success','Student Fee Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studentfee  $studentfee
     * @return \Illuminate\Http\Response
     */
    public function show(Studentfee $studentfee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studentfee  $studentfee
     * @return \Illuminate\Http\Response
     */
    public function edit(Studentfee $studentfee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studentfee  $studentfee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studentfee $studentfee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studentfee  $studentfee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studentfee $studentfee)
    {
        $studentfee->delete();

        return redirect()->route('studentfees.index')
                        ->with('success','Student Fee Deleted Successfully.');
    }
}
