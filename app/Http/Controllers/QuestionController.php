<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\subjectExpert;
use App\Models\Subject;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Mcqtype;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // $this->authorize('create', Question::class);

        $questionData = Question::latest()->get();
        // dd($questionData);
        if (auth()->user()->userType != 1) {

            // if user is intitute
            if (auth()->user()->userType == 2) {

                $question_id = [];
              foreach ($questionData as $key => $question_value) {
                  if ($question_value->institute_id != auth()->id()) {
                unset($questionData[$key]);
            } else {

                $questionData = Question::where(['user_id' => auth()->id()])->latest()->get();


            }
          }
        }
      }

        return view('question.index',compact('questionData'));

        // $questionData = Question::all();

        // if (auth()->user()->userType !=1) {
        //     $question_id = [];
        //       foreach ($questionData as $key => $question_value) {
        //           if ($question_value->institute_id != auth()->id()) {
        //         unset($questionData[$key]);
        //                  }
        //                  else{
        //           $question_id[] = $question_value->id;
        //       }
        //     }
        //  }

        // return view('question.index',compact('questionData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      // $this->authorize('create', Question::class);

      if(auth()->user()->userType == 2){
        foreach (auth()->user()->institute->institutecourse as $key=> $course_value) {
            $course_arr[] = $course_value->course->id;
        }
        $subjectData = Subject::whereIn('course_id',$course_arr)->get();

    }
    else if(auth()->user()->userType == 3){

        foreach (auth()->user()->instructor->institute->institutecourse as $key=> $course_value) {
            $course_arr[] = $course_value->course->id;
        }
        $subjectData = Subject::whereIn('course_id',$course_arr)->get();

    }
        // dd($subjectData);

        $mcqtypeData = Mcqtype::all();

        // if (auth()->user()->userType ==3) {

        //     $subjectData = Subject::whereIn('id',[auth()->user()->subject_expert->subject_id])->get();

        // }



        return view('question.create',compact('subjectData','mcqtypeData'));

        // $subjectData = Subject::all();
        // $mcqtypeData = Mcqtype::all();

        // if (auth()->user()->userType ==3) {

        //     $subject_id = [];
        //     foreach (auth()->user()->subject_expert as $key => $subject_value) {
        //         $subject_id[] = $subject_value->subject_id;
        //     }

        //     $subjectData = Subject::whereIn('id',$subject_id)->get();

        // }

        // return view('question.create',compact('subjectData','mcqtypeData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // $this->authorize('create', Question::class);

        $data = request()->validate([
            // 'subject_id'    => 'required',
            // 'mcq_type_id'   => 'required',
            'que'           => 'required',
            'wright_ans'    => 'required',
            'is_mcq'        => 'required',
            'explanation'   => 'required',
            'mcq_1'         => '',
            'mcq_2'         => '',
            'mcq_3'         => '',
            'mcq_4'         => '',
        ]);

        // if is_mcq == 1
        if ($request->is_mcq == 1) {
            $mcqData = request()->validate([
                'mcq_2' => 'required',
                'mcq_3' =>  'required',
                'mcq_4' =>  'required',
            ]);
        }


        if($request->hindique != null){

            $validate = request()->validate([
                'hindi_explanation' =>'required',
                'hindiwright_ans' =>'required',
                'hindi_mcq1' =>'',
                'hindi_mcq2' =>'',
                'hindi_mcq3' =>'',
                'hindi_mcq4' =>'',

            ]);

            if($request->is_mcq == 1) {
                $mcqData = request()->validate([

                'hindi_mcq2' =>'required',
                'hindi_mcq3' =>'required',
                'hindi_mcq4' =>'required',
                ]);
            }

        }

           if($request->marathique != null){

            $validate = request()->validate([
                'marathi_explanation' =>'required',
                'marathiwright_ans' =>'required',
                'marathi_mcq1' =>'',
                'marathi_mcq2' =>'',
                'marathi_mcq3' =>'',
                'marathi_mcq4' =>'',

            ]);

            if($request->is_mcq == 1) {
                $mcqData = request()->validate([

                'marathi_mcq2' =>'required',
                'marathi_mcq3' =>'required',
                'marathi_mcq4' =>'required',
                ]);
            }

        }


        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $questionData = auth()->user()->question()->create([
            'institute_id'  => $auth_id,
            // 'subject_id'    => $data['subject_id'],
            // 'mcq_type_id'   => $data['mcq_type_id'],
            'que'           => $data['que'],
            'hindique'           => $request->hindique,
            'marathique'           =>  $request->marathique,
            'wright_ans'    => $data['wright_ans'],
            'marathiwright_ans'    =>  $request->marathiwright_ans,
            'hindiwright_ans'    =>  $request->hindiwright_ans,
            'is_mcq'        => $data['is_mcq'],
            'explanation'   => $data['explanation'],
            'hindi_explanation'   =>  $request->hindi_explanation,
            'marathi_explanation'   =>  $request->marathi_explanation,
        ]);



//        dd(auth()->user()->question());

        $answerData = new Answer;
        $answerData->question_id = $questionData->id;
        $answerData->ans = $data['mcq_1'];
        $answerData->ansmarathi = $request->marathi_mcq1;
        $answerData->anshindi = $request->hindi_mcq1;
        $answerData->save();

        if ($request->wright_ans == 1) {
            $questionData->fill([
                'wright_ans' => $answerData->id,
                'marathiwright_ans' => $answerData->id,
                'hindiwright_ans' => $answerData->id,
            ])->update();
        }

        $answerData = new Answer;
            $answerData->question_id = $questionData->id;
            $answerData->ans = $data['mcq_2'];
            $answerData->ansmarathi = $request->marathi_mcq2;
            $answerData->anshindi = $request->hindi_mcq2;
            $answerData->save();

            if ($request->wright_ans == 2) {
                $questionData->fill([
                    'wright_ans' => $answerData->id,
                    'marathiwright_ans' => $answerData->id,
                    'hindiwright_ans' => $answerData->id,
                ])->update();
            }

        if ($request->is_mcq == 1) {

            $answerData = new Answer;
            $answerData->question_id = $questionData->id;
            $answerData->ans = $data['mcq_3'];
            $answerData->ansmarathi = $request->marathi_mcq3;
            $answerData->anshindi = $request->hindi_mcq3;
            $answerData->save();

            if ($request->wright_ans == 3) {
                $questionData->fill([
                    'wright_ans' => $answerData->id,
                    'marathiwright_ans' => $answerData->id,
                    'hindiwright_ans' => $answerData->id,
                ])->update();
            }

            $answerData = new Answer;
            $answerData->question_id = $questionData->id;
            $answerData->ans = $data['mcq_4'];
            $answerData->ansmarathi = $request->marathi_mcq4;
            $answerData->anshindi = $request->hindi_mcq4;
            $answerData->save();

            if ($request->wright_ans == 4) {
                $questionData->fill([
                    'wright_ans' => $answerData->id,
                    'marathiwright_ans' => $answerData->id,
                    'hindiwright_ans' => $answerData->id,
                ])->update();
            }
        }


        return redirect()->route('question.index')->with('status','Question Created Successfully');

        // $userData = $request->validate([
        //     'subject_id'    => 'required',
        //     'que'           => 'required',
        //     'wright_ans'    => 'required',
        //     'is_mcq'        => 'required',
        //     'mcq_type_id'   => 'required',
        //     'explation'     => 'required',
        // ]);

        // if (auth()->user()->userType == 2) {

        //    $auth_id = auth()->id();
        // }
        // else{

        //     $auth_id = auth()->user()->instructor->institute_id;
        // }

        // $userData = Question::create([
        //     'institute_id'  => $auth_id,
        //     'subject_id'    => $userData['subject_id'],
        //     'que'           => $userData['que'],
        //     'wright_ans'    => $userData['wright_ans'],
        //     'is_mcq'        => $userData['is_mcq'],
        //     'mcq_type_id'   => $userData['mcq_type_id'],
        //     'explation'     => $userData['explation'],
        // ]);

        // // if is_mcq == 1
        // if ($request->is_mcq == 1) {
        //     $mcqData = request()->validate([
        //         'mcq_2' => 'required',
        //         'mcq_3' =>  'required',
        //         'mcq_4' =>  'required',
        //     ]);
        // }

        //  $questionData = Question::create([
        //     'institute_id'  => $auth_id,
        //     'subject_id'    => $request->subject_id,
        //     'que'           => $request->que,
        //     'wright_ans'    => $request->wright_ans,
        //     'is_mcq'        => $request->is_mcq,
        //     'mcq_type_id'   => $request->mcq_type_id,
        //     'explation'     => $request->explation,
        // ]);

        // $answerData = new Answer;
        // $answerData->question_id = $questionData->id;
        // $answerData->ans = $request->mcq_1;
        // $answerData->save();

        // if ($request->is_mcq == 1) {

        //     $answerData = new Answer;
        //     $answerData->question_id = $questionData->id;
        //     $answerData->ans = $request->mcq_2;
        //     $answerData->save();

        //     $answerData = new Answer;
        //     $answerData->question_id = $questionData->id;
        //     $answerData->ans = $request->mcq_3;
        //     $answerData->save();

        //     $answerData = new Answer;
        //     $answerData->question_id = $questionData->id;
        //     $answerData->ans = $request->mcq_4;
        //     $answerData->save();
        // }


        // return redirect()->route('question.index')->with('status','Question Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // $this->authorize('update', $question);

        return view('question.show',compact('question'));

        // $wright_ansData = Answer::where(['question_id' => $question->id])->get();

        // if ($question->is_mcq == 0) {
        //     $wright_answer = $wright_ansData[0];
        // } else {
        //     $wright_answer = $wright_ansData[$question->wright_ans];
        // }



        // return view('question.show',compact('question','wright_answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        // $this->authorize('update', $question);

        $wright_ansData = Answer::where(['question_id' => $question->id])->get()->pluck('id');

        if(auth()->user()->userType == 2){
            foreach (auth()->user()->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        }
        else if(auth()->user()->userType == 3){

            foreach (auth()->user()->instructor->institute->institutecourse as $key=> $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id',$course_arr)->get();

        }

        $mcqtypeData = Mcqtype::all();

        return view('question.edit',compact('question','subjectData','mcqtypeData'));

        // $wright_ansData = Answer::where(['question_id' => $question->id])->get();

        // $subjectData = Subject::all();

        // if ($question->is_mcq == 0) {
        //     $wright_answer = $wright_ansData[0];
        // } else {
        //     $wright_answer = $wright_ansData[$question->wright_ans];
        // }

        // // dd($question->answer[0]->ans);

        // return view('question.edit',compact('question','wright_answer','subjectData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {


//         $this->authorize('update', $question);
    //    dd($request->all());


        $data = request()->validate([
            // 'subject_id'    => 'required',
            // 'mcq_type_id'   => 'required',
            'que'           => 'required',
            'wright_ans'    => 'required',
            'is_mcq'        => 'required',
            'explanation'   => 'required',
            'mcq_1'         => 'required',
            'mcq_2'         => '',
            'mcq_3'         => '',
            'mcq_4'         => '',
        ]);

        if ($request->marathique != null) {

            $validate = request()->validate([
                'explanation_marathi' => 'required',
                'marathiwright_ans' => 'required',
                'marathi_mcq1' => '',
                'marathi_mcq2' => '',
                'marathi_mcq3' => '',
                'marathi_mcq4' => '',



            ]);

            if ($request->is_mcq == 1){

                $mcqData = request()->validate([
                    'marathi_mcq2' => 'required',
                    'marathi_mcq3' => 'required',
                    'marathi_mcq4' => 'required',
                ]);
            }

        }



            if ($request->hindique != null) {

            $validate = request()->validate([
                'explanation_hindi' => 'required',
                'hindiwright_ans' => 'required',
                'hindi_mcq1' => '',
                'hindi_mcq2' => '',
                'hindi_mcq3' => '',
                'hindi_mcq4' => '',



            ]);

            if ($request->is_mcq == 1){

                $mcqData = request()->validate([
                    'hindi_mcq2' => 'required',
                    'hindi_mcq3' => 'required',
                    'hindi_mcq4' => 'required',
                ]);
            }

        }

        // if is_mcq == 1
        if ($request->is_mcq == 1) {
            $mcqData = request()->validate([
                'mcq_2' => 'required',
                'mcq_3' =>  'required',
                'mcq_4' =>  'required',
            ]);
        }

        $question->fill([
            'que'               => $data['que'],
            'marathique' => $request->quemarathi,
            'hindique' => $request->quehindi,
            // 'subject_id'        => $data['subject_id'],
            // 'mcq_type_id'       => $data['mcq_type_id'],
            'is_mcq'            => $data['is_mcq'],
            'wright_ans'        => $data['wright_ans'],
            'marathiwright_ans' => $request->marathiwright_ans,
            'hindiwright_ans' => $request->hindiwright_ans,
            'explanation'       => $data['explanation'],
            'explanation_marathi' => $request->marathiwright_ans,
            'explanation_hindi' => $request->hindi_explanation,
        ])->update();

        $oldAnswer = Answer::where(['question_id' => $question->id])->delete();



        $answerData = new Answer;
        $answerData->question_id = $question->id;
        $answerData->ans = $request->mcq_1;
        $answerData->ansmarathi = $request->marathi_mcq1;
        $answerData->anshindi = $request->hindi_mcq1;
        $answerData->save();

        if ($request->wright_ans == 1) {
            $question->fill([
                'wright_ans' => $answerData->id,
                'marathiwright_ans' => $answerData->id,
                'hindiwright_ans' => $answerData->id,
            ])->update();
        }

        $answerData = new Answer;
        $answerData->question_id = $question->id;
        $answerData->ans = $data['mcq_2'];
        $answerData->ansmarathi = $request->marathi_mcq2;
        $answerData->anshindi = $request->hindi_mcq2;
        $answerData->save();

        if ($request->wright_ans == 2) {
            $question->fill([
                'wright_ans' => $answerData->id,
                'marathiwright_ans' => $answerData->id,
                'hindiwright_ans' => $answerData->id,
            ])->update();
        }


        if ($request->is_mcq == 1) {


            $answerData = new Answer;
            $answerData->question_id = $question->id;
            $answerData->ans = $data['mcq_3'];
            $answerData->ansmarathi = $request->marathi_mcq3;
            $answerData->anshindi = $request->hindi_mcq3;
            $answerData->save();

            if ($request->wright_ans == 3) {
                $question->fill([
                    'wright_ans' => $answerData->id,
                    'marathiwright_ans' => $answerData->id,
                    'hindiwright_ans' => $answerData->id,
                ])->update();
            }

            $answerData = new Answer;
            $answerData->question_id = $question->id;
            $answerData->ans = $data['mcq_4'];
            $answerData->ansmarathi = $request->marathi_mcq4;
            $answerData->anshindi = $request->hindi_mcq4;
            $answerData->save();

            if ($request->wright_ans == 4) {
                $question->fill([
                    'wright_ans' => $answerData->id,
                'marathiwright_ans' => $answerData->id,
                'hindiwright_ans' => $answerData->id,
                ])->update();
            }
        }


        return redirect()->route('question.index')->with('status','Question Update Successfully.');


        // $data = request()->validate([
        //     'subject_id'    => 'required',
        //     'que'           => 'required',
        //     'wright_ans'    => 'required',
        //     'is_mcq'        => 'required',
        //     'mcq_type'      => 'required',
        //     'explation'     => 'required',
        //     'mcq_1'         => 'required',
        // ]);

        // // if is_mcq == 1
        // if ($request->is_mcq == 1) {
        //     $mcqData = request()->validate([
        //         'mcq_2' => 'required',
        //         'mcq_3' =>  'required',
        //         'mcq_4' =>  'required',
        //     ]);
        // }

        // $question->fill([
        //     'que'               => $request->que,
        //     'subject_id'        => $request->subject_id,
        //     'is_mcq'            => $request->is_mcq,
        //     'mcq_type'          => $request->mcq_type,
        //     'wright_ans'        => $request->wright_ans,
        //     'explation'         => $request->explation
        // ])->update();

        // $oldAnswer = Answer::where(['question_id' => $question->id])->delete();

        // $answerData = new Answer;
        // $answerData->question_id = $question->id;
        // $answerData->ans = $request->mcq_1;
        // $answerData->save();

        // if ($request->is_mcq == 1) {

        //     $answerData = new Answer;
        //     $answerData->question_id = $question->id;
        //     $answerData->ans = $request->mcq_2;
        //     $answerData->save();

        //     $answerData = new Answer;
        //     $answerData->question_id = $question->id;
        //     $answerData->ans = $request->mcq_3;
        //     $answerData->save();

        //     $answerData = new Answer;
        //     $answerData->question_id = $question->id;
        //     $answerData->ans = $request->mcq_4;
        //     $answerData->save();
        // }


        // return redirect()->route('question.index')->with('status','Question Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {

        // $this->authorize('update', $question);

        $question->delete();

        return back()->with('status','Question Deleted Successfully.');
        // $question->delete();

        // return back()->with('status','Question Deleted Successfully.');
    }
}
