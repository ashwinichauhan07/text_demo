<?php

namespace App\Http\Controllers;

use App\Models\Itiming;
use Illuminate\Http\Request;

class ItimingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itimings = Itiming::all();

         if (auth()->user()->userType !=1) {
            $itiming_id = [];
              foreach ($itimings as $key => $itiming_value) {
                  if ($itiming_value->institute_id != auth()->id()) {
                unset($itimings[$key]);
                         }
                         else{
                  $itiming_id[] = $itiming_value->id;
              }
            }
         }

//        $time1 = new \Nette\Utils\DateTime($itimings[0]->start_time);
//        $time2 = new \Nette\Utils\DateTime($itimings[0]->end_time);
//        $timediff = $time1->diff($time2);
//
//        $var = $timediff->h.":".$timediff->i.":".$timediff->s;
//
//        dd($var);

        return view('itimings.index',compact('itimings'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('itimings.create');
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
            'start_time' => 'required',
            'end_time' => 'required',
        ]);


        // $test = date_format($request->start_time, 'G:i');

        $start_time = date( 'h:i a', strtotime($request->start_time));

        $end_time = date('h:i a', strtotime($request->end_time));



        // dd($start_time);


        Itiming::create([
         'institute_id' => auth()->id(),
         'start_time' => $request->start_time,
          'end_time' => $request->end_time,
        ]);

        return redirect()->route('itimings.index')
                    ->with('success','Session Time Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Itiming  $itiming
     * @return \Illuminate\Http\Response
     */
    public function show(Itiming $itiming)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Itiming  $itiming
     * @return \Illuminate\Http\Response
     */
    public function edit(Itiming $itiming)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Itiming  $itiming
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Itiming $itiming)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itiming  $itiming
     * @return \Illuminate\Http\Response
     */
    public function destroy(Itiming $itiming)
    {
         $itiming->delete();

        return redirect()->route('itimings.index')
                        ->with('success','Session Time Deleted Successfully.');
    }
}
