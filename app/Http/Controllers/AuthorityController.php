<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institute;
use PDF;

class AuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user =Institute::all();

                $institute = [];

              foreach ($user as $key => $user_value) {
                  $institute[] =$user_value->address;
              }

        if (auth()->user()->userType !=1) {
            $inst_id = [];
              foreach ($user as $key => $user_value) {
                  if ($user_value->user_id != auth()->id()) {
                    unset($institute[$key]);
                       }
            }
         }


        $address = implode(",", $institute);

    // $studenData['add'] =  $address;
                        
    // $data = [
    //         'data' => $studenData, 
    //     ];
         
         // dd($data);
        return view('authority.index',compact('address'));
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

    public function createPDF() {


        $user =Institute::all();

                $institute = [];

              foreach ($user as $key => $user_value) {
                  $institute[] =$user_value->address;
              }

        if (auth()->user()->userType !=1) {
            $inst_id = [];
              foreach ($user as $key => $user_value) {
                  if ($user_value->user_id != auth()->id()) {
                    unset($institute[$key]);
                       }
            }
         }


        $address = implode(",", $institute);
      

    $studenData['add'] =  $address;
                        
    $data = [
            'data' => $studenData, 
        ];
         
         // dd($data);
      $pdf = PDF::loadView('pdf.form', $data);

      // download PDF file with download method
      return $pdf->download('form.pdf');
    }
}
