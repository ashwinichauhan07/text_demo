<?php

namespace App\Http\Controllers;

use App\Models\Coursefee;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Institute;
use App\Models\InstituteCourse;
use App\Models\StudentType;
use Illuminate\Support\Facades\Validator;



class CoursefeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $coursefees = Coursefee::latest()->paginate(5);

         $coursefees = Coursefee::all();

        if (auth()->user()->userType !=1) {
            $coursefee_id = [];
              foreach ($coursefees as $key => $coursefee_value) {
                  if ($coursefee_value->institute_id != auth()->id()) {
                unset($coursefees[$key]);
                         }
                         else{
                  $coursefee_id[] = $coursefee_value->id;
              }
            }
         }

         // dd($coursefees);

        return view('coursefees.index',compact('coursefees'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courseData = Course::all();

        $subjectData = Subject::all();

        $institute =Institute::all();

        if (auth()->user()->userType == 2) {

           $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $studentType =StudentType::where('institute_id',$auth_id)->get();

        return view('coursefees.create',compact('courseData','subjectData','institute','studentType'));
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
            'subject_id' => 'required',
            'course_id' => 'required',
            'student_type' => 'required',
            'fees' => 'required',
        ]);

          $course_Data = $request->course_id;



         $course = Course::Where('id', $request->course_id)->first();

         $course_Data = $course->id;

          // dd($course_Data);

         $coursefee =Coursefee::where(['institute_id'=>auth()->id(),
           'subject_id'=>$data['subject_id'],
            'course_id'=>$course_Data,
            'student_type'=>$data['student_type']
            ])->first();

            // dd($coursefee);

         if ($coursefee != null) {

             return redirect()->back()->with('error',"The data has already been taken.");
         }

         // dd($coursefee);

        $data = Coursefee::create([
          'institute_id' => auth()->id(),
          'subject_id' => $data['subject_id'],
          'course_id' => $course_Data,
           'student_type' => $data['student_type'],
           'fees' => $data['fees'],

        ]);

        // dd($data);

        return redirect()->route('coursefees.index')
                    ->with('success','Course Fees Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coursefee  $coursefee
     * @return \Illuminate\Http\Response
     */
    public function show(Coursefee $coursefee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coursefee  $coursefee
     * @return \Illuminate\Http\Response
     */
    public function edit(Coursefee $coursefee)
    {
        $courseData = Course::all();

        $subjectData = Subject::all();

        return view('coursefees.edit',compact('coursefee','courseData','subjectData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coursefee  $coursefee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coursefee $coursefee)
    {
          $data = $request->validate([
            'course_id' => 'required',
            'subject_id' => 'required',
            'student_type' => 'required',
            'fees' => 'required',
        ]);

         $course = Course::Where('id', $request->course_id)->first();

         $course_Data = $course->id;

         // dd($coursefee);

         $coursefee->fill([
          'subject_id' => $data['subject_id'],
           'course_id' => $course_Data,
           'student_type' => $data['student_type'],
           'fees' => $data['fees'],
        ])->update();



        // $coursefee->update($request->all());

        return redirect()->route('coursefees.index')
                    ->with('success','Course Fee Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coursefee  $coursefee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coursefee $coursefee)
    {
        $coursefee->delete();

        return redirect()->route('coursefees.index')
                        ->with('success','Course Fee Deleted Successfully.');
    }

    public function subfilter(Request $request)
    {
        $data = [];
        $validate = Validator::make($request->all(),[
            'course_id' => "required",
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
            //dd($message);
            //dd($validate->errors()->all());
        }

         // dd($validate->validated()['course_id']);

        $subjectData = Subject::where('course_id',$validate->validated()['course_id'])->get();

        // dd($validate->validated()['course_id']);
        return response()->json([
                'status' => true,
                'message' => "subjectData list",
                'data' => $subjectData,
            ]);
        //dd($subjectData);
        //dd($validate->fails());
        //dd($validate->validated()['course_id']);

    }
}
