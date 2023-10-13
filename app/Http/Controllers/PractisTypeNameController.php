<?php

namespace App\Http\Controllers;

use App\Models\PractisTypeName;
use Illuminate\Http\Request;

class PractisTypeNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $practiseType = PractisTypeName::all();

        return view('practisetypename.index',compact('practiseType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practisetypename.create');
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
            'name'=>'required|unique:subjects',
        ]);

        PractisTypeName::create($request->all());

        return redirect()->route('practisetypename.index')->with('status','PractisType Name Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PractisTypeName  $practisTypeName
     * @return \Illuminate\Http\Response
     */
    public function show(PractisTypeName $practisTypeName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PractisTypeName  $practisTypeName
     * @return \Illuminate\Http\Response
     */
    public function edit(PractisTypeName $practisTypeName)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PractisTypeName  $practisTypeName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PractisTypeName $practisTypeName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PractisTypeName  $practisTypeName
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd($id);

        $practiseType = PractisTypeName::find($id);

        $practiseType->delete();

        return redirect()->route('practisetypename.index')->with('status','PractisType Deleted.');

    }
}
