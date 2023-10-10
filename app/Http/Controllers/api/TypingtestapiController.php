<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PractiseType;
use App\Models\Typingtest;
use App\Models\Student;
use App\Models\Typing_test_result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypingtestapiController extends Controller
{
    public function passagetest(Request $request)
    {

        $data = [];

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
                'data' => $data
            ]);
        }

        $practiseType = PractiseType::where(['subject_id' => $request->subject_id, 'practise_type' => 1])
            ->whereIn('name', ['SpeedPassage30', 'SpeedPassage40'])
            ->first();

     // dd($practiseType);


        if ($practiseType == null) {
            return response()->json([
                'status' => false,
                'message' => 'practiseType id not found',
                'data' => $data
            ]);
        }

       // dd($practiseType);

        $passagetest = Typingtest::with('practise')->where('subject_id', $request->subject_id)
            ->where('practise_type', $practiseType->id)->get();


            // dd($passagetest);


        return response()->json([
            'status' => true,
            'message' => 'Passage Data',
            'data' => $passagetest
        ]);

    }



    public function lettertest(Request $request)
    {

        $data = [];

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
                'data' => $data
            ]);
        }

        $practiseType = PractiseType::where(['subject_id' => $request->subject_id, 'practise_type' => 1])
            ->whereIn('name', ['SpeedLetter30', 'SpeedLetter40'])
            ->first();

        if ($practiseType == null) {
            return response()->json([
                'status' => false,
                'message' => 'practiseType id not found',
                'data' => $data
            ]);
        }

        $lettertest = Typingtest::with('practise')
        ->where('subject_id', $request->subject_id)
            ->where('practise_type', $practiseType->id)->get();


             // dd($lettertest);
        return response()->json([
            'status' => true,
            'message' => 'Letter Data',
            'data' => $lettertest
        ]);

    }

    public function statementtest(Request $request)
    {

        $data = [];

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
                'data' => $data
            ]);
        }

        $practiseType = PractiseType::where(['subject_id' => $request->subject_id, 'practise_type' => 1])
            ->whereIn('name', ['SpeedStatement30', 'SpeedStatement40'])
            ->first();

        if ($practiseType == null) {
            return response()->json([
                'status' => false,
                'message' => 'practiseType id not found',
                'data' => $data
            ]);
        }

        $lettertest = Typingtest::with('practise')->where('subject_id', $request->subject_id)
            ->where('practise_type', $practiseType->id)->get();


             // dd($lettertest);

        return response()->json([
            'status' => true,
            'message' => 'Statement Data',
            'data' => $lettertest
        ]);

    }

    public function emailtest(Request $request)
    {

        $data = [];

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all(),
                'data' => $data
            ]);
        }

        $practiseType = PractiseType::where(['subject_id' => $request->subject_id, 'practise_type' => 1])
            ->whereIn('name', ['SpeedEmail30', 'SpeedEmail40'])
            ->first();

        if ($practiseType == null) {
            return response()->json([
                'status' => false,
                'message' => 'practiseType id not found',
                'data' => $data
            ]);
        }

        $lettertest = Typingtest::with('practise')->where('subject_id', $request->subject_id)
            ->where('practise_type', $practiseType->id)->get();

            // dd($practiseType->id);

        return response()->json([
            'status' => true,
            'message' => 'Email Data',
            'data' => $lettertest
        ]);

    }

    public function typingtest_result(Request $request)
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

        $typingpractise = Typingtest::where('id', $request->passage_id)
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

            $passageresult = Typing_test_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typingtest_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Result Save Succesfully',
                'data' => $passageresult
            ]);
        }

        if ($type_id->name == "SpeedLetter30") {

            $validate = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
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

            $resultSave = Typing_test_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typingtest_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
            ]);

            $letterresult = $resultSave->letter30_result()->create([
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
        if ($type_id->name == "SpeedStatement30") {

            $validate = Validator::make($request->all(), [
                // 'user_id' => 'required',
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
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

            $resultSave = Typing_test_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typingtest_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
//                'countlength' => $request->countlength,
            ]);

//            dd($resultSave->statement30_result());

            $statementresult = $resultSave->statementtest30_result()->create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'head' => $request->head,
                'columnhead' => $request->columnhead,
                'celalign' => $request->celalign,
                'colwidth' => $request->colwidth,
                'border' => $request->border,
                'former' => $request->former,
                'total' => $request->total,
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
                'time' => 'required',
                'tmark' => 'required',
                'obtmark' => 'required',
                'countmistake' => 'required',
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

            $resultSave = Typing_test_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typingtest_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
            ]);

            $statementresult =  $resultSave->statementtest40_result()->create([
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
        }

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

            $resultSave = Typing_test_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typingtest_id' => $request->passage_id,
                'practise_type' => $request->type_id,
                'time' => $request->time,
                'tmark' => $request->tmark,
                'obtmark' => $request->obtmark,
                'countmistake' => $request->countmistake,
            ]);

            $emailresult =  $resultSave->emailtest30_result()->create([
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

            $resultSave = Typing_test_result::create([
                'student_id' => auth()->id(),
                'institute_id' => $student->institute_id,
                'subject_id' => $typingpractise->subject_id,
                'typingtest_id' => $request->passage_id,
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

