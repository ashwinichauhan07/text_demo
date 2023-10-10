<?php

namespace App\Http\Controllers;

use App\Models\Instructorpayment;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\User;

class InstructorpaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructorpaymentData = Instructorpayment::all();

        $instructors = Instructor::with('user')->Where("institute_id", auth()->id())->get(); 

        return view('instructorpayments.index', compact('instructors','instructorpaymentData'));
        /*
        $instructorpayments = Instructorpayment::latest()->paginate(5);

        return view('instructorpayments.index',compact('instructorpayments'))
                    ->with('i', (request()->input('page', 1) - 1) * 5); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $instructorData = Instructor::all();

        return view('instructorpayments.create',compact('instructorData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $instructorData = $request->validate([
            'name'      => 'required',
            'amount'    => 'required',
            'mode'      => 'required',
        ]);


         $instructorData = User::where('id',$request->name)->first();


         // dd($instructorData);

        if ($request->mode == 1) {


            $instructorData->instructor->instructorpayment()->create([
            'institute_id'  => auth()->id(),
            'name'          =>  $request->name,
            'amount'        =>  $request->amount,
            'mode'          =>  $request->mode,
            ]);

        } else {

            $chec = request()->validate([
                'cheque_number' =>   'required',
                'cheque_date'  =>   'required',
            ]);

             $instructorData->instructor->instructorpayment()->create([
            'institute_id'  => auth()->id(),
            'name'          =>  $request->name,
            'amount'        =>  $request->amount,
            'mode'          =>  $request->mode,
            'cheque_number' => $request->cheque_number,
            'cheque_date'   => $request->cheque_date,
            ]);
        }
        return redirect()->route('instructorpayments.index')->with('success','Instructor Payment Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructorpayment  $instructorpayment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Instructorpayment::where('instructor_id', $id)
        ->get();
          // dd($instructorpayment->amount);
         return view('instructorpayments.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructorpayment  $instructorpayment
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructorpayment $instructorpayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructorpayment  $instructorpayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructorpayment $instructorpayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructorpayment  $instructorpayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructorpayment $instructorpayment)
    {
         $instructorpayment->delete();

        return redirect()->route('instructorpayments.index')
                        ->with('success','Instructor Payment Deleted Successfully.');
    }

     public function payment_report(Request $request)
    {
        $instructorData = Instructor::with('user')->get();

        $instructor = [];


        if (isset($request->name) && !empty($request->name)) {

            // $instructor = User::with('instructor')->where(['name'=>$request->name])
            // ->where('userType',3)
            // ->get();

             $instructor = Instructor::with('user')->where(['user_id' => $request->name])
             ->Where("institute_id", auth()->id())
            ->get();


            // dd($instructor);

        }

        // dd($request->name);

        return view('instructorpayments.payment_report',compact('instructorData','instructor'));
    
}
}
