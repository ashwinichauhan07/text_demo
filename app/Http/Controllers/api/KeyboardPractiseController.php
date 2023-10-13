<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\KeboardPractice;
use App\Models\PractiseType;
use App\Models\User;
use App\Models\KeyboardPractiseResult;

use Illuminate\Support\Facades\Validator;






class KeyboardPractiseController extends Controller
{


    public function keyboardpractisetype(Request $request){

        $student = Student::with('institute')->where('user_id',auth()->id())->first();

        // dd($student);

        $subjectId =[];

        foreach ($student->student_subject as $key=> $subject_value) {

            if ($subject_value->old == 0) {

                $subjectId[] = $subject_value->subject_id;
            }
        }

        $keyboardpractiseType = PractiseType::with('subject')->where('institute_id',$student->institute_id)
            ->whereIn('subject_id',$subjectId)
            ->where('practise_type',0)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'student keboard Practise Type',
            'data' => $keyboardpractiseType
        ]);


    }


    public function keyboardData(Request $request){

        $student = Student::with('institute')->where('user_id',auth()->id())->first();

        // dd($student);

        $subjectId =[];

        foreach ($student->student_subject as $key=> $subject_value) {

            if ($subject_value->old == 0) {

                $subjectId[] = $subject_value->subject_id;
            }
        }

        $keyboardData = KeboardPractice::with('practise')->where('institute_id',$student->institute_id)
            ->whereIn('subject_id',$subjectId)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'student keboard Practise Type',
            'data' => $keyboardData
        ]);


    }




    public function keyboardpractiseresult(Request $request)
    {
        $data = [];

        $user = User::find(auth()->id());

        // dd($user->student->institute_id);

        $validate = Validator::make($request->all(), [
            'subject_id' => 'required',
            'keboard_practice_id' => 'required',
            'practise_type' => 'required',
            'correctWords' => 'required',
            'acc' => 'required',
            'incorrectWords' => 'required',
            'timeminute' => 'required',
            'speed' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()->all(),
                'data' => $data
            ]);
        }


        $result_data = KeyboardPractiseResult::create([
            'student_id' => auth()->id(),
            'institute_id' => $user->student->institute_id,
            'subject_id' => $request->subject_id,
            'keboard_practice_id' => $request->keboard_practice_id,
            'practise_type' => $request->practise_type,
            'correctWords' => $request->correctWords,
            'acc' => $request->acc,
            'incorrectWords' => $request->incorrectWords,
            'timeminute' => $request->timeminute,
            'speed' => $request->speed

      ]);

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $result_data
            ]);
        }



}
