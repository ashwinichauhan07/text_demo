<?php

namespace App\Http\Controllers;

use App\Models\PractiseType;
use App\Models\TypingPractise;
use App\Models\Typingtest;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class TypingtestController extends Controller
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

        $typingtestData = Typingtest::where('institute_id',$auth_id)->get();

        return view('typingtest.index',compact('typingtestData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $course_arr =[];

        if(auth()->user()->userType == 2){
            foreach (auth()->user()->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        }
        else{

            foreach (auth()->user()->instructor->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        }




        // dd($course_arr);



        $sectionData = Section::all();
        // $subjectData = Subject::all();
        return view('typingtest.create',compact('sectionData','subjectData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataUpload = $request->validate([
            'practise_type' => 'required',
            'subject_id' => 'required',
            'typingdata'=>'required',
        ]);

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }
//        dd($upload);

        $practiseType = PractiseType::where('institute_id',$auth_id)->where('id',$request->practise_type)
            ->where('subject_id',$request->subject_id)->first();

//        dd($practiseType->id);
        $explode = explode(' ',$practiseType->subject->name);
//        dd($explode[0]);

        if($request->typingdata != null){

            if($request->hasfile('typingdata'))
            {
                $id = Typingtest::where('practise_type',$practiseType->id)->latest('id')->first();



//           dd($id);
                foreach($request->file('typingdata') as $key => $file)
                {

                    if ($id != null){
                        $ke = 1 + $id->key + $key;
                    }
                    else
                    {
                        $ke = 1 + $key;
                    }

//                $number = rand(0, 9);
//dd($k);
//                $name = $explode[0].$practiseType->name.$number.'.'.$file->extension();

                    if ($practiseType->name == "SpeedPassage30"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
//                    dd($name);
                    }
                    else if ($practiseType->name == "SpeedPassage40"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
//                    dd($name);
                    }
                    else if ($practiseType->name == "SpeedLetter30"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
//                    dd($name);
                    }
                    else if ($practiseType->name == "SpeedLetter40"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
//                    dd($name);
                    }
                    else if ($practiseType->name == "SpeedStatement30"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
//                    dd($name);
                    }
                    else if ($practiseType->name == "SpeedStatement40"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
//                    dd($name);
                    }
                    else if ($practiseType->name == "SpeedEmail30"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
//                    dd($name);
                    }
                    else if ($practiseType->name == "SpeedEmail40"){
                        $name = $explode[0].$practiseType->name.'-'.$ke.'.'.$file->extension();
//                    dd($name);
                    }

//                dd($name);
//                $name = $practiseType->name.'-'.$number++   .'.'.$file->extension();

                    $file->move(public_path().'/typing_test/', $name);
                    $data[] = $name;

                    // dd($data);

//                $upload->update(['typingdata' => json_encode($data)]);

//                 $upload->upload_typingpractise()->create([
//                  'typingdata'=>$name,
//             ]);

                    $upload = Typingtest::create([
                        'institute_id' => $auth_id,
                        'practise_type' => $request->practise_type,
                        'subject_id' => $request->subject_id,
                        'typingdata' => $name,
                        'key' => $ke,
                    ]);

                }
            }
        }

        return redirect()->route('typingtest.index')->with('status','Typingtest is Created.');
    }

    public function practisetype_data(Request $request)
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
            ->Where("practise_type", 1)
            ->get();

        return response()->json([
            'status' => true,
            'message' => "practise_type list",
            'data' => $practise_type,
        ]);
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
    public function destroy(Typingtest $typingtest)
    {
        $typingtest->delete();

        return redirect()->route('typingtest.index')->with('status','Typingtest Delete Successfully.');
    }
}
