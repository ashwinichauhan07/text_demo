<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\LicensePayment;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Total_payment;
use Illuminate\Http\Request;

class LicensePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $licesePayment = LicensePayment::where('institute_id',$auth_id)->get();


     // dd($licesePayment);
    // $licesePayment = $licese->unique('student_id');

        return view('licensepayment.index',compact('licesePayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $license = License::first();
        $student = Student::where('institute_id', $auth_id)->get();

//        $student = StudentSubject::where('institute_id', $auth_id)->whereNotIn('institute_id',$licensePayment)
//            ->whereNotIn('subject_id',$licenseSubject)
//            ->get();
//        dd($licensePayment);
        return view('licensepayment.create', compact('student', 'license'));
    }

    public function payment(Request $request)
    {
//        dd($request->all());
        $validate = request()->validate([
            'student_id' => 'required',
            'subject_id' => 'required',
//             'payment_id'=>'required'
        ]);


        $license = License::first();

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $subject_id = $request->subject_id;
//       $student_sub = [];
        foreach ($request->student_id as $key => $subject_value) {
            $student_sub = StudentSubject::whereIn('id', $subject_id)->get();
        }

        foreach ($student_sub as $key => $payment_value) {

            $licesesData = LicensePayment::where(['institute_id' => auth()->id(),
                'subject_id' => $payment_value->subject_id,
                'student_id' => $payment_value->student_id,
                'amount' => $license->license_fee
            ])->first();

//            dd($student_sub);
            if ($licesesData != null) {

                return redirect()->route('licensepayment.create', compact('licesesData'))->with('error', "Allready paid amount");
            }
        }

         return view("licensepayment.payment",compact('student_sub','license'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $licesesData = "";

        $validate = request()->validate([
            'student_id' => 'required',
            'subject_id' => 'required',
//             'payment_id'=>'required'
        ]);

        $amount = 0;
        foreach ($request->amount as $value){
            $amount += $value;
        }
        $license = License::first();

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }
        $data = Total_payment::create([
            'institute_id' => $auth_id,
            'payment' => $amount
        ]);

//        dd($data->licensepayment());
        $subject_id = $request->subject_id;
//       $student_sub = [];
        foreach ($request->student_id as $key => $subject_value) {
            $student_sub = StudentSubject::whereIn('id', $subject_id)->get();
        }

        foreach ($student_sub as $key => $payment_value) {
            $data->licensepayment()->create([
                'institute_id' => $payment_value->institute_id,
                'student_id' => $payment_value->student_id,
                'subject_id' => $payment_value->subject_id,
                'amount' => $license->license_fee,
                'amount_status' => 1,
                'added_by' => $auth_id,
            ]);
        }

        return redirect()->route('licensepayment.index')->with('status', 'payment successfully Completed');
//dd($student_sub);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\LicensePayment $licensePayment
     * @return \Illuminate\Http\Response
     */
    public function show(LicensePayment $licensePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\LicensePayment $licensePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(LicensePayment $licensePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LicensePayment $licensePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LicensePayment $licensePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\LicensePayment $licensePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(LicensePayment $licensePayment)
    {
        //
    }
}
