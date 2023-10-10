<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\User;
use App\Models\Student;
use App\Models\Studentinstallments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use App\Notifications\RegisterNotify;


class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::with('user')->get();

        $instructors = Instructor::with('user')->Where("institute_id", auth()->id())->get();

        /*   if (auth()->user()->userType != 1) {
             $instructor_id = [];

             foreach ($instructors as $key => $instructor_value) {
                 if ($instructor_value->institute_id != auth()->id()) {
                     unset($instructors[$key]);


                 } else {
                     $instructor_id[] = $instructor_value->user_id;

                 }
             }
         } */

        return view('instructors.index', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $instructorData = Instructor::all();

        return view('instructors.create', compact('instructorData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'userType' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'phone_no' => 'required|unique:instructors|max:10|min:10',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'address' => 'required',
            'stream' => 'required',
            'university' => 'required',
            'passingyear' => 'required',
            'percent' => 'required',
            'grade' => 'required',
            'password' => 'required|confirmed|min:6',
            'identity_img' => '',
            // 'inst_img'=> 'required',
        ]);

// dd($request->all);
        //insert data into user
        $userData = new User;
        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->password = Hash::make($request->password);
        $userData->userType = $request->userType;
        $userData->email_verified_at = now();
        $userData->save();


//        dd($userData);
        $userData->instructor()->create([
            'institute_id' => auth()->id(),
             'inst_id' => auth()->user()->institute->id,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'gender' => $request->gender,
            'address' => $request->address,
            'stream' => $request->stream,
            'university' => $request->university,
            'passingyear' => $request->passingyear,
            'percent' => $request->percent,
            'grade' => $request->grade,
            'identity_img' => "",

        ]);

        if ($request->identity_img != null) {
            $image = $request->file('identity_img');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);

            $userData->instructor()->update([
                'identity_img' => $imageName,
            ]);
        }

        $userData->notify(new RegisterNotify($userData));

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        return view('instructors.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            // 'phone_no'  => ['required','max:10','min:10',Rule::unique('instructors')->ignore($instructor->phone_no,'phone_no'),],
            // 'email' =>['required',Rule::unique('users')->ignore($instructor->user->email,'email'),],
            'gender' => 'required',
            'address' => 'required',
            'stream' => 'required',
            'university' => 'required',
            'passingyear' => 'required',
            'percent' => 'required',
            'grade' => 'required',
            // 'password' => 'required|min:8'
            'identity_img' => 'required',
        ]);

        $instructor->user->fill([
            'name' => $request->name
            // 'email'     => $request->email,
            // 'password'  => Hash::make($request->password),
        ])->update();

        $instructor->fill([
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            // 'phone_no' => $request->phone_no,
            'gender' => $request->gender,
            'address' => $request->address,
            'stream' => $request->stream,
            'university' => $request->university,
            'passingyear' => $request->passingyear,
            'percent' => $request->percent,
            'grade' => $request->grade,
            'identity_img' => $instructor->identity_img,
        ])->update();

        if ($request->identity_img != null) {

            $image = $request->file('identity_img');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);

            $instructor->fill([
                'identity_img' => $imageName,
            ])->update();
        }

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Instructor $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        $instructor->delete();

        $instructor->user->delete();

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor Deleted Successfully.');
    }

  

    public function report(Request $request)
    {
        $instructorData = Instructor::all();

        $student = [];

        $student_installments = [];

        $start_date = '20' . date('y') . '-0' . $request->month_id . '-01 00:00:00';

        $end_date = '20' . date('y') . '-0' . $request->month_id . '-31 23:59:00';

        // dd($end_date);

        if (isset($request->name) && !empty($request->name)) {


            $instructor = Instructor::with('user')->where(['user_id' => $request->name])
                ->where('institute_id', auth()->id())->get();

            $instructor_id = [];

            foreach ($instructor as $key => $value) {

                $instructor_id  [] = $value->user_id;
            }

            if ($request->student == "student_data") {

                $student = Student::where("created_id", $instructor_id)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->get();

            } elseif ($request->studentInstallment == "studentInstallment_data") {
                $student_installments = Studentinstallments::with('student')
                    ->where(['type' => 1])
                    ->where("created_id", $instructor_id)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->get();
            }
            // dd($student_installments);
        }

        return view('instructors.report', compact('instructorData', 'student', 'student_installments'));
    }

    public function details(Request $request)
    {
        $data = array();

        $userData = User::with('instructor')->where(['name' => $request->name])
            ->where(['userType' => 3])
            ->first();


        if (!is_null($userData)) {

            $userData->instructor->course;
            $userData->instructor->subject;

            // fees details
            $total = Instructorpayment::where(['instructor_id' => $userData->instructor->id])
                ->where(['type' => 2])->first();

            $paid = Instructorpayment::where(['instructor_id' => $userData->instructor->id])
                ->where(['type' => 1])->get();

            $paid_amount = 0;
            foreach ($paid as $key => $paid_value) {
                $paid_amount += $paid_value->amount;
            }

            $unpaid = Instructorpayment::where(['instructor_id' => $userData->instructor->id])
                ->where(['type' => 2])->get();

            $unpaid_amount = 0;
            foreach ($unpaid as $key => $unpaid_value) {
                $unpaid_amount += $unpaid_value->amount;
            }


            $userData['payment'] = $total->amount;
            $userData['paid_payment'] = $paid_amount;
            $userData['unpaid_payment'] = $unpaid_amount - $paid_amount;


            return response()->json([
                'status' => true,
                'message' => 'Instructor Data',
                'data' => $userData,
            ]);

        }
    }
}
