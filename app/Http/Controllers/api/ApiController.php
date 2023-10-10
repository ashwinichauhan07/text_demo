<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Letter_result;
use App\Models\PractiseType;
use App\Models\Student;
use App\Models\Student_keyboardPractise;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\Typing_practise_result;
use App\Models\Student_batch;
use App\Models\TypingPractise;
use App\Models\Typingtest;
use App\Models\Upload_typingpractise;
use App\Models\User;
use App\Models\Itiming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function studentlogin(Request $request)
    {
        $data = [];

        $credentials  = Validator::make($request->all(), [
            'otp' => 'required',
        ]);


//        dd(auth()->user());

        if ($credentials->fails()) {

            return response()->json([
                'status' => false,
                'message' => $credentials->errors()->all(),
                'data' => $data
            ]);
        }

//        if (Auth::attempt($credentials->validated())) {
//
//            $token = auth()->user()->createToken(auth()->id());
//
//            return response()->json([
//                'status' => true,
//                'message' => 'Student credentials',
//                'data' => $token->plainTextToken,
//            ]);
//        }

        $user = User::where('otp',$request->otp)->first();
        if ($user != null){

            $token = $user->createToken($user->id);
//dd($token);
            return response()->json([
                'status' => true,
                'message' => 'Student credentials',
                'data' => $token->plainTextToken
            ]);
//        dd($user);
        }
        return response()->json([
            'status' => false,
            'message' => 'login fail',
        ]);
    }

    public function exeinvoke(Request $request)
    {

//        dd(auth()->user());

        $user = User::where('id',auth()->id())->first();

        $typing_data = TypingPractise::with('practise')->where('id',$user->typing_id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Practise Data',
            'data' => $typing_data
        ]);
//        dd($request->all());SS
    }

    public function logout(Request $request)
    {

        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'user logout successfully',
            'data' => []
        ]);

    }

    public function student_details(Request $request){
//
        $student = Student::with('user')
            ->where('user_id',auth()->id())->first();

        return response()->json([
            'status' => true,
            'message' => 'Student Institute',
            'data' => $student

        ]);

    }

    public function student_insitute(Request $request){

        $institute = Institute::with('user')
            ->where('user_id',auth()->user()->student->institute_id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Student Institute',
            'data' => $institute
        ]);

    }



    public function student_batch(Request $request){

        $data = null;

        $id = Student::where('user_id', auth()->id())->first();

        $studentbatch = Student_batch::where('student_id', $id->id)
        ->pluck('batch_id');

        $time_data = Itiming::whereIn('id', $studentbatch)->get();

        $current_time = date("G:i");



        foreach ($time_data as $key => $value) {

            $exlpode_time = explode(":", $value->start_time);

            $end_time = $exlpode_time[0] += 1;

            // dd($end_time);


            $exlpode_current_time = explode(":", $current_time);

            $currentTime = $exlpode_current_time[0] += 1;

            $batch_time = Itiming::whereBetween('start_time', [$current_time, $currentTime])
                ->where('institute_id', $id->institute_id)
                ->first();



            if ($batch_time == null) {

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return response()->json([
                    'status' => true,
                    'message' => 'This is not your Batch Time',
                    'data' => $institute
                ]);



            } else {

                $time = Student_batch::where('student_id', $id->id)
                    ->where('batch_id', $batch_time->id)->first();


                if ($time == null) {


                    return response()->json([
                        'status' => true,
                        'message' => 'This is not your Batch Time',
                        'data' => $data
                    ]);
                }

                else{

                    $start = strtotime($batch_time->end_time);
                    $end = strtotime($current_time);
                    $mins = ($start - $end) / 60;
                    // dd($mins);

                    $batch_time['timediff'] = $mins;


                    return response()->json([
                        'status' => true,
                        'message' => 'Student batch time',
                        'data' => $batch_time
                    ]);

                }


            }

        }





    }

    public function student_subject(Request $request){

        $student = StudentSubject::with('subject')
            ->where('student_id',auth()->user()->student->id)
            ->where('old',0)
            ->get();

        //        dd($student);

        return response()->json([
            'status' => true,
            'message' => 'student Subject',
            'data' => $student
        ]);

    }

    public function student_practisetype(Request $request){

        $student = Student::with('institute')->where('user_id',auth()->id())->first();

        $subjectId =[];

        foreach ($student->student_subject as $key=> $subject_value) {

            if ($subject_value->old == 0) {

                $subjectId[] = $subject_value->subject_id;
            }
        }

        $practiseType = PractiseType::where('institute_id',$student->institute_id)
            ->whereIn('subject_id',$subjectId)
            ->where('practise_type',1)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'student Practise Type',
            'data' => $practiseType
        ]);

    }

    public function student_typingdata(Request $request)
    {
        $student = Student::with('institute')->where('user_id',auth()->id())->first();

        $subjectId =[];

        foreach ($student->student_subject as $key=> $subject_value) {

            if ($subject_value->old == 0) {

                $subjectId[] = $subject_value->subject_id;
            }
        }

        $typingData = TypingPractise::where('institute_id',$student->institute_id)
            ->whereIn('subject_id',$subjectId)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'user start practise successfully',
            'data' => $typingData
        ]);
        //
        //        dd($typingData);
    }

    public function downloadfile(Request $request)
    {
        $data = [];

        $validator = Validator::make($request->all(), [
            'passage_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
                'data' => $data
            ]);
        }

        $typingpractise = TypingPractise::where('id', $request->passage_id)->first();

        if ($typingpractise == null) {

            return response()->json([
                'status' => false,
                'message' => 'Passage id not found',
                'data' => $data
            ]);
        }

        $typingData = TypingPractise::with('subject')
            ->where('institute_id', auth()->user()->student->institute_id)
            ->where('id', $request->passage_id)
            ->first();

        $url = url("/public/typing_data") . "/" . $typingData->typingdata;

        return response()->json([
            'status' => true,
            'message' => 'File save suucessfully',
            'data' => $url
        ]);

//         dd($typingData);
    }

    public function practiseTypeData(Request $request)
    {

// dd($request->passage_id);

        $data = [];

        $validator = Validator::make($request->all(), [
            'passage_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
                'data' => $data
            ]);
        }

        $typingpractise = TypingPractise::where('id', $request->passage_id)->first();

        if ($typingpractise == null) {

            return response()->json([
                'status' => false,
                'message' => 'Passage id not found',
                'data' => $data
            ]);

        }

//        dd($typingpractise);

//        $passageData = PractiseType::with('subject')->where('id', $typingpractise->practise_type)->first();

        $typingdata = TypingPractise::where('id', $request->passage_id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Typing Practise Type Data',
            'data' => $typingpractise
        ]);
    }



//    public function practiseTypeData(Request $request)
//    {
//
//// dd($request->passage_id);
//
//        $data = [];
//
//        $validator = Validator::make($request->all(), [
//            'passage_id' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//
//            return response()->json([
//                'status' => false,
//                'message' => $validator->errors()->all(),
//                'data' => $data
//            ]);
//        }
//
//        $typingpractise = TypingPractise::where('id', $request->passage_id)->first();
//
//        if ($typingpractise == null) {
//
//            return response()->json([
//                'status' => false,
//                'message' => 'Passage id not found',
//                'data' => $data
//            ]);
//
//        }
//
////        dd($typingpractise);
//
//        $passageData = PractiseType::with('subject')->where('id', $typingpractise->practise_type)->first();
//
//        return response()->json([
//            'status' => true,
//            'message' => 'Practise Type Data',
//            'data' => $passageData
//        ]);
//    }


    public function test(Request $request)
    {
        $data = [];

        if ($request->type == 0) {

            $validate = Validator::make($request->all(), [
                'passage_id' => 'required',
                'user_id' => 'required',
                'type' => 'required',
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
                'countlength' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()->all(),
                    'data' => $data
                ]);
            }
        } else if ($request->type == 1) {
            $validate = Validator::make($request->all(), [
                'passage_id' => 'required',
                'user_id' => 'required',
                'type' => 'required',
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
                'countlength' => 'required',
                'head' => 'required',
                'reference' => 'required',
                'add' => 'required',
                'sub' => 'required',
                'salute' => 'required',
                'paragraph' => 'required',
                'close' => 'required',
                'enclosure' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()->all(),
                    'data' => $data
                ]);
            }
        }

        $typingpractise = TypingPractise::where('id', $request->passage_id)->first();

        if ($typingpractise == null) {

            return response()->json([
                'status' => false,
                'message' => 'Passage id not found',
                'data' => $data
            ]);
        }

        $student = Student::where('user_id', $request->user_id)->first();

        if ($student == null) {
            return response()->json([
                'status' => false,
                'message' => 'Student id not found',
                'data' => $data
            ]);
        }
        $practiseData = TypingPractise::where('id', $request->passage_id)->first();

        if ($request->type == 0) {

            $resultSave = Typing_practise_result::create([
                'student_id' => $request->user_id,
                'institute_id' => $student->institute_id,
                'subject_id' => $practiseData->subject_id,
                'typing_practise_id' => $request->passage_id,
                'practise_type' => $practiseData->practise_type,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
                'countlength' => $request->countlength,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $resultSave
            ]);

        } elseif ($request->type == 1) {

            $resultSave = Typing_practise_result::create([
                'student_id' => $request->user_id,
                'institute_id' => $student->institute_id,
                'subject_id' => $practiseData->subject_id,
                'typing_practise_id' => $request->passage_id,
                'practise_type' => $practiseData->practise_type,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
                'countlength' => $request->countlength,
            ]);

            $letterresult = $resultSave->letter_result()->create([
                'student_id' => $request->user_id,
                'institute_id' => $student->institute_id,
                'subject_id' => $practiseData->subject_id,
                'head' => $request->head,
                'reference' => $request->reference,
                'add' => $request->add,
                'sub' => $request->sub,
                'salute' => $request->salute,
                'paragraph' => $request->paragraph,
                'close' => $request->close,
                'enclosure' => $request->enclosure,

            ]);

            $resultSave['result'] = $letterresult;

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $resultSave
            ]);
        }
    }

    public function typing_result(Request $request)
    {
        $data = [];
        $validate = Validator::make($request->all(), [
            'passage_id' => 'required',
            'type_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()->all(),
                'data' => $data
            ]);
        }

        $type_id = PractiseType::where('id', $request->type_id)->first();

        if ($type_id == null) {
            return response()->json([
                'status' => false,
                'message' => 'type id not found',
                'data' => $data
            ]);
        }

        $typingpractise = TypingPractise::where('id', $request->passage_id)
            ->where('practise_type', $request->type_id)
            ->first();
//         = TypingPractise::where('id', $request->passage_id)->first();

        if ($typingpractise == null) {

            return response()->json([
                'status' => false,
                'message' => 'Passage id not found',
                'data' => $data
            ]);
        }

        if ($type_id->name == "SpeedPassage30" || $type_id->name == "SpeedPassage40") {

            $validate = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
//                'countlength' => 'required',

            ]);

            if ($validate->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()->all(),
                    'data' => $data
                ]);
            }

            $student = Student::where('user_id', auth()->id())->first();

            if ($student == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student id not found',
                    'data' => $data
                ]);
            }

            $resultSave = Typing_practise_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typing_practise_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
//                'countlength' => $request->countlength,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $resultSave
            ]);
        }

        if ($type_id->name == "SpeedLetter30") {

            $validate = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
//                'countlength' => 'required',
                'head' => 'required',
                'reference' => 'required',
                'add' => 'required',
                'sub' => 'required',
                'salute' => 'required',
                'paragraph' => 'required',
                'close' => 'required',
                'enclosure' => 'required',
            ]);

            if ($validate->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()->all(),
                    'data' => $data
                ]);
            }

            $student = Student::where('user_id', auth()->id())->first();

            if ($student == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student id not found',
                    'data' => $data
                ]);
            }

            $resultSave = Typing_practise_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typing_practise_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
//                'countlength' => $request->countlength,
            ]);

            $letterresult = $resultSave->letter_result()->create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'head' => $request->head,
                'reference' => $request->reference,
                'add' => $request->add,
                'sub' => $request->sub,
                'salute' => $request->salute,
                'paragraph' => $request->paragraph,
                'close' => $request->close,
                'enclosure' => $request->enclosure,
            ]);

            $resultSave['result'] = $letterresult;

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $resultSave
            ]);
        }
//        dd($type_id->name);
        if ($type_id->name == "SpeedStatement30") {

            $validate = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
//                'countlength' => 'required',
                'head' => 'required',
                'columnhead' => 'required',
                'celalign' => 'required',
                'colwidth' => 'required',
                'border' => 'required',
                'former' => 'required',
                'total' => 'required',
            ]);

            if ($validate->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()->all(),
                    'data' => $data
                ]);
            }

            $student = Student::where('user_id', auth()->id())->first();
            if ($student == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student id not found',
                    'data' => $data
                ]);
            }

            $resultSave = Typing_practise_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typing_practise_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
//                'countlength' => $request->countlength,
            ]);

//            dd($resultSave->statement30_result());

            $statementresult = $resultSave->statement30_result()->create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'head' => $request->head,
                'columnhead' => $request->columnhead,
                'celalign' => $request->celalign,
                'colwidth' => $request->colwidth,
                'border' => $request->border,
                'former' => $request->former,
                'total' => $request->total,student_batch
            ]);

            $resultSave['result'] = $statementresult;

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $resultSave
            ]);
        }

        if ($type_id->name == "SpeedStatement40") {
            $validate = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
//                'countlength' => 'required',
                'headfig' => 'required',
                'colheading' => 'required',
                'alignment' => 'required',
                'width' => 'required',
                'borders' => 'required',
                'questions' => 'required',
                'marksform' => 'required',
                'totmark' => 'required',
            ]);

            if ($validate->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()->all(),
                    'data' => $data
                ]);
            }

            $student = Student::where('user_id', auth()->id())->first();
            if ($student == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student id not found',
                    'data' => $data
                ]);
            }

            $resultSave = Typing_practise_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typing_practise_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
//                'countlength' => $request->countlength,
            ]);

            $statementresult =  $resultSave->statement40_result()->create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'headfig' => $request->headfig,
                'colheading' => $request->colheading,
                'alignment' => $request->alignment,
                'width' => $request->width,
                'borders' => $request->borders,
                'questions' => $request->questions,
                'marksform' => $request->marksform,
                'totmark' => $request->totmark,
            ]);

            $resultSave['result'] = $statementresult;

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $resultSave
            ]);
//            dd($resultSave->statement40_result());
        }

//        Email30 result save

        if ($type_id->name == "SpeedEmail30") {
            $validate = Validator::make($request->all(), [
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
                'mailId' => 'required',
                'mailSub' => 'required',
                'mailBody' => 'required',
                'mailSave' => 'required',
                'mailAtt' => 'required',
            ]);

            if ($validate->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()->all(),
                    'data' => $data
                ]);
            }

            $student = Student::where('user_id', auth()->id())->first();
            if ($student == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student id not found',
                    'data' => $data
                ]);
            }

            $resultSave = Typing_practise_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typing_practise_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
//                'countlength' => $request->countlength,
            ]);

            $emailresult =  $resultSave->email30_result()->create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'mailId' => $request->mailId,
                'mailSub' => $request->mailSub,
                'mailBody' => $request->mailBody,
                'mailSave' => $request->mailSave,
                'mailAtt' => $request->mailAtt,
            ]);

            $resultSave['result'] = $emailresult;

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $resultSave
            ]);
//            dd($resultSave->statement40_result());
        }

//        Email40 result save

        if ($type_id->name == "SpeedEmail40") {
            $validate = Validator::make($request->all(), [
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
                'EmailSend' => 'required',
                'EmailTo' => 'required',
                'EmailCc' => 'required',
                'EmailBcc' => 'required',
                'EmailSubject' => 'required',
                'EmailBody' => 'required',
                'EmailAtt1' => 'required',
                'EmailAtt2' => 'required',
//                'Lbody' => 'required',
//                'Rbody' => 'required',
            ]);

            if ($validate->fails()) {

                return response()->json([
                    'status' => false,
                    'message' => $validate->errors()->all(),
                    'data' => $data
                ]);
            }

            $student = Student::where('user_id', auth()->id())->first();
            if ($student == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student id not found',
                    'data' => $data
                ]);
            }

            $resultSave = Typing_practise_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typing_practise_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
//                'countlength' => $request->countlength,
            ]);

            $emailresult =  $resultSave->email40_result()->create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'EmailSend' => $request->EmailSend,
                'EmailTo' => $request->EmailTo,
                'EmailCc' => $request->EmailCc,
                'EmailBcc' => $request->EmailBcc,
                'EmailSubject' => $request->EmailSubject,
                'EmailBody' => $request->EmailBody,
                'EmailAtt1' => $request->EmailAtt1,
                'EmailAtt2' => $request->EmailAtt2,
//                'Lbody' => $request->Lbody,
//                'Rbody' => $request->Rbody,
            ]);

            $resultSave['result'] = $emailresult;

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $resultSave
            ]);
//            dd($resultSave->statement40_result());
        }
    }
                               
}


