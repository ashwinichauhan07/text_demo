<?php

namespace App\Http\Controllers;

use App\Models\KeboardPractice;
use App\Models\PractiseType;
use App\Models\Student_keyboardPractise;
use App\Models\Subject;
use App\Models\KeyboardPractiseResult;
use App\Models\InstituteCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeboardPracticeController extends Controller
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
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $keyboardPractice = KeboardPractice::where('institute_id',$auth_id)->get();

         // dd($keyboardPractice);

        return view('keboardPractice.index',compact('keyboardPractice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $course_arr =[];

        foreach (auth()->user()->institute->institutecourse as $key=> $course_value) {

            $course_arr[] = $course_value->course->id;

        }

        // dd($course_arr);

        $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        // dd($subjectData);

         $practiseType = PractiseType::where('institute_id',auth()->id())
        // ->where('practise_type',0)
        ->get();

        // dd($practiseType);

        return view('keboardPractice.create',compact('subjectData','practiseType'));
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
            'name'=>'required',
            'desc'=>'required',
            'practise_type' => 'required',
            'subject_id' => 'required',
        ]);

        // dd($data);

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $typing_data =KeboardPractice::where([
            'institute_id'=>$auth_id,
            'name' => $data['name'],
            'subject_id' => $data['subject_id'],
            'practise_type' => $data['practise_type'],
            ])->first();

         if ($typing_data != null) {

             return redirect()->back()->with('error',"The data has already been taken.");
         }

       $data = KeboardPractice::create([
               'institute_id' => $auth_id,
               'subject_id' => $data['subject_id'],
               'name' => $data['name'],
               'practise_type' => $data['practise_type'],
               'desc' => $data['desc'],
        ]);

        return redirect()->route('keboardPractice.index')->with('status','keboard Practice Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeboardPractice  $keboardPractice
     * @return \Illuminate\Http\Response
     */
    public function show(KeboardPractice $keboardPractice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeboardPractice  $keboardPractice
     * @return \Illuminate\Http\Response
     */
    public function edit(KeboardPractice $keboardPractice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeboardPractice  $keboardPractice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeboardPractice $keboardPractice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeboardPractice  $keboardPractice
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeboardPractice $keboardPractice)
    {
         $keboardPractice->delete();

        return redirect()->route('keboardPractice.index')->with('status','keboard Practice Delete Successfully.');
    }

     public function practise_type(Request $request)
    {
       $data =[];

      $validate = Validator::make($request->all(),[
          'subject_id' => 'required',
      ]);

      if ($validate->fails()) {
          $message = "";
          foreach ($validate->errors()->all() as $key => $error_value) {
               $message .= $error_value. '|';
          }

           return response()->json([
                'status' => false,
                'message' => $message,
                'data' => $data,
            ]);
       }


            if (auth()->user()->userType == 2) {
               $auth_id = auth()->id();
            }
            else{
                $auth_id = auth()->user()->instructor->institute_id;
            }

             $practise_type = PractiseType::where('subject_id',$validate->validated()['subject_id'])
             ->Where("institute_id", $auth_id)
             ->Where("practise_type", 0)
             ->get();

        return response()->json([
                'status' => true,
                'message' => "practise_type list",
                'data' => $practise_type,
            ]);
}

         public function typingpractise(KeboardPractice $keboardPractice) {

              return view('keboardPractice.typingpractise',compact('keboardPractice'));

            }

         public function keboard_practice(Request $request){

//              dd($request->all());

            $result_data = KeyboardPractiseResult::create([
               'student_id' => $request->student_id,
               'institute_id' => $request->institute_id,
               'subject_id' => $request->subject_id,
               'keboard_practice_id' => $request->keboard_practice_id,
               'practise_type' => $request->practise_type,
               'correctWords' => $request->correctWords,
               'acc' => $request->acc,
               'incorrectWords' => $request->incorrectWords,
               'timeminute' => $request->timeminute,
               'speed' => $request->speed

         ]);

         return response()->json(
             [
               'success' => true,
               'message' => 'Result inserted successfully',
               'data' => $result_data,
             ]
        );
         }

    public function student_keboardpractice(Request $request){

        $student_practise = Student_keyboardPractise::create([
            'student_id' => $request->student_id,
            'institute_id' => $request->institute_id,
            'subject_id' => $request->subject_id,
            'keboard_practice_id' => $request->keboard_practice_id,
            'practise_type' => $request->practise_type,
        ]);



        return response()->json(
            [
                'success' => true,
                'message' => 'Student start practise',
                'data' => $student_practise,
            ]
        );
    }

}
