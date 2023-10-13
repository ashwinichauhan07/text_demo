<?php

namespace App\Http\Controllers;

use App\Models\Isession;
use App\Models\Month;
use App\Models\Student;
use Illuminate\Http\Request;


class IsessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isessions = Isession::latest()->paginate(5);

        if (auth()->user()->userType != 1) {
            $isession_id = [];
            foreach ($isessions as $key => $isession_value) {
                if ($isession_value->institute_id != auth()->id()) {
                    unset($isessions[$key]);
                } else {
                    $isession_id[] = $isession_value->id;
                }
            }
        }

        return view('isessions.index', compact('isessions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $month = Month::all();

        return view('isessions.create',compact('month'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = $request->validate([
            'start_session' => 'required',
            'end_session' => 'required',
        ]);

        $userData = Isession::create([
            'institute_id' => auth()->id(),
            'start_session' => $userData['start_session'],
            'end_session' => $userData['end_session'],
        ]);


        return redirect()->route('isessions.index')
            ->with('success', 'Session Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Isession $isession
     * @return \Illuminate\Http\Response
     */
    public function show(Isession $isession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Isession $isession
     * @return \Illuminate\Http\Response
     */
    public function edit(Isession $isession)
    {
        $month = Month::all();

        return view('isessions.edit', compact('isession','month'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Isession $isession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Isession $isession)
    {
//        dd($request->all());

        $validate = request()->validate([
//            'start_session' => 'required',
            'end_session' => 'required',
        ]);

        $isession->update($request->all());

        return redirect()->route('isessions.index')->with('status', 'Session Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Isession $isession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Isession $isession)
    {

        if ($isession->start_session == "1") {
//            dd('l');
            $isession->update([
                'start_session' => "1",
                'end_session' => '6',
            ]);
        } elseif ($isession->start_session == "6") {

            $isession->update([
                'start_session' => "6",
                'end_session' => '12',
            ]);
        }

        return redirect()->route('isessions.index')
            ->with('success', 'Session Reset Successfully.');
    }

    public function active(Request $request, Isession $isession)
    {

        if ($request->active == "Active") {
//            dd('l');
            $isession->update([
                'active' => "1",
            ]);
        } elseif ($request->dactive == "Dactive") {

            $isession->update([
                'active' => "0",
            ]);
        }


        return redirect()->route('isessions.index')->with('status', 'Session Updated.');
    }
}
