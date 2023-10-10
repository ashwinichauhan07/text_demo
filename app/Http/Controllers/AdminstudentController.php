<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Institute;

class AdminstudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $studentData = [];

        // dd($request->name);
        $instituteData = User::where('userType',2)->get();
        // dd($instituteData);

        $students = User::where('userType',4)->get();

        $record = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->where('userType',4)
        ->groupBy('day_name','day')
        ->orderBy('day','desc')
        ->get();



        $data = [];
        foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
        }


        $data_count = 0;
        if (isset($data['data']) && !empty($data['data'])) {

            foreach ($data['data'] as $key => $data_value) {
            $data_count += $data_value;
            }

            $data['count'] = $data_count;

        }

         $data['chart_data'] = json_encode($data);

          if (isset($request->name) && !empty($request->name)) {

             $studentData = Student::with('user')
             -> where('institute_id', $request->name)
             ->get();
         }

        return view('adminstudent.index',compact('students', 'instituteData','studentData'),$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
