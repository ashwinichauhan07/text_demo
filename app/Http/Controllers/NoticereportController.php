<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Student;



class NoticereportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $custemNotification = DB::table('notifications')->get();
         
        foreach ($custemNotification as $key => $custem_value) {

            $type_str = str_replace('\\',' ',$custem_value->type);

            $type = explode(' ', $type_str);

            $custem_value->type = $type[2];

            $data = json_decode($custem_value->data);

            $custem_value->data = $data->message;

            $custem_value->subject = $data->subject;

            $custem_value->name = $data->name;
           
        }

        $result_data = $data->message;
        $result_name = $data->name;
        //dd($data->name);

       
        $userData = User::where('id','!=',1)->get();
        

        
        $students = Student::with('user')->get();

          return view('noticereport.index',compact('custemNotification','userData', 'result_data', 'result_name', 'students'));
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
