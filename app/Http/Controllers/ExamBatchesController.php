<?php

namespace App\Http\Controllers;

use App\Models\ExamBatches;
use App\Models\ExamName;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;



class ExamBatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exmBatch =ExamBatches::all();

         if (auth()->user()->userType !=1) {
            $exmBatch_id = [];
              foreach ($exmBatch as $key => $exmBatch_value) {
                  if ($exmBatch_value->institute_id != auth()->id()) {
                unset($exmBatch[$key]);
                         }
                         else{
                  $exmBatch_id[] = $exmBatch_value->id;
              }
            }
         }

        return view('examBatches.index',compact('exmBatch'));
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

        $ExamData = ExamName::where('institute_id',$auth_id)->get();

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

        return view('examBatches.create', compact('ExamData','subjectData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $data = $request->validate([
            'exam_date' => 'required',
            'subject_id' => 'required',
            'batch_number' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'day' => 'required',
            'exam_name' => 'required',

        ]);


        $exambatch =ExamBatches::where(['institute_id'=>auth()->id(),
        'batch_number'=>$data['batch_number'],
         'exam_name'=>$data['exam_name']
         ])->first();

      if ($exambatch != null) {

        // dd($exambatch);

          return redirect()->back()->with('error',"The Batch name has already been taken.");
      }

     $data = ExamBatches::create([
            'institute_id' => auth()->id(),
            'exam_date' => $data['exam_date'],
            'subject_id' => $data['subject_id'],
            'batch_number' =>  $data['batch_number'],
            'start_time' => $data['start_time'],
            'end_time' =>  $data['end_time'],
            'day' =>  $data['day'],
            'exam_name' =>  $data['exam_name'],
        ]);


        return redirect()->route('examBatches.index')
                    ->with('success','Exam Batch Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamBatches  $examBatches
     * @return \Illuminate\Http\Response
     */
    public function show(ExamBatches $examBatches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamBatches  $examBatches
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamBatches $examBatches)
    {

        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        } else {

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $ExamData = ExamName::where('institute_id',$auth_id)->get();

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
         return view('examBatches.edit',compact('examBatches','ExamData','subjectData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamBatches  $examBatches
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamBatches $examBatches)
    {
        $data = $request->validate([
            'exam_date' => 'required',
            'subject_id' => 'required',
            'batch_number' =>['required',Rule::unique('exam_batches')->ignore($examBatches->batch_number,'batch_number'),],
            'start_time' => 'required',
            'end_time' => 'required',
            'day' => 'required',
            'exam_name' => 'required',
        ]);

        $examBatches->update($request->all());


        return redirect()->route('examBatches.index')
                    ->with('edit','Exam Batch Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamBatches  $examBatches
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamBatches $examBatches)
    {
         $examBatches->delete();

        return redirect()->route('examBatches.index')->with('status','Exam Batch Delete Successfully.');
    }
}
