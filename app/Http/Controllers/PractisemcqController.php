<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\McqAnswer;
use App\Models\Mcqtype;
use App\Models\Practisemcq;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\image;
use App\Models\File;
use Illuminate\Http\Request;
use App\Models\Practicemcq as MyPracticemcq;
use Illuminate\Support\Facades\Storage;






 

class PractisemcqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $practise_question = Practisemcq::latest()->get();
        // dd($practise_question);
        if (auth()->user()->userType == 2) {

            $auth_id = auth()->id();
        }
        else{

            $auth_id = auth()->user()->instructor->institute_id;
        }

        $practise_question = Practisemcq::where(['user_id' => $auth_id])->latest()->get();


//        dd($practise_question);


        return view('practicemcq.index',compact('practise_question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
                // dd($mcqtypeData);


//        if (auth()->user()->userType == 3) {
//
//            $subjectData = Subject::whereIn('id', [auth()->user()->subject_expert->subject_id])->get();
//
//        }
        return view('practicemcq.create',compact('subjectData','mcqtypeData'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $data = request()->validate([
        'institute_id' => '',       // You should specify validation rules for 'institute_id'
        'subject_id' => 'required',
        'mcq_type_id' => 'required',
        'is_mcq' => '',
        'file' => '',
        'name' => '',
    ]);

    $languageColumn = '';
    $subjectId = $data['subject_id'];

    if ($subjectId == 1 || $subjectId == 2) {
        $languageColumn = 'que'; // English subjects (30wpm or 40wpm)
    } elseif ($subjectId == 3) {
        $languageColumn = 'quemarathi'; // Marathi 30wpm
    } elseif ($subjectId == 4) {
        $languageColumn = 'quemarathi'; // Marathi 40wpm
    } elseif ($subjectId == 5) {
        $languageColumn = 'quehindi'; // Hindi 30wpm
    } elseif ($subjectId == 6) {
        $languageColumn = 'quehindi'; // Hindi 40wpm
    }

    $auth_id = null; // Initialize the variable with a default value

    if (auth()->user()->userType == 2) {
        $auth_id = auth()->id();
    } else {
        $auth_id = auth()->user()->instructor->institute_id;
    }

    $file = $request->file('file');

if ($file && $file->getClientOriginalExtension() === 'csv') {
    $filePath = $file->getPathname();
    if (($handle = fopen($filePath, 'r')) !== false) {
        // Remove the BOM from the file
        $bom = fread($handle, 3);
        if ($bom === "\xEF\xBB\xBF") {
            fseek($handle, 3);
        } else {
            rewind($handle);
        }

        // Specify the correct encoding
        $csvEncoding = 'UTF-8'; // Update with the actual encoding of the CSV file

        while (($row = fgetcsv($handle, 0, ',', '"')) !== false) {
            $wright_ans = end($row); // Extract the last column as 'wright_ans'
            
            // Convert the row data to the desired encoding
            $row = array_map(function($item) use ($csvEncoding) {
                return mb_convert_encoding($item, 'UTF-8', $csvEncoding);
            }, $row);
$questionData = new Practisemcq();
$questionData->user_id = auth()->id(); // Assign the user ID
$questionData->institute_id = $auth_id;
$questionData->subject_id = $data['subject_id'];
$questionData->mcq_type_id = $data['mcq_type_id'];
$questionData->is_mcq = $data['is_mcq'];
$questionData->$languageColumn = $row[0]; // Assign question to the appropriate column

$questionData->save();
$options = array_slice($row, 1, 4);

foreach ($options as $key => $option) {
    $answerData = new McqAnswer();
    $answerData->practisemcq_id = $questionData->id;

    if ($languageColumn === 'quemarathi') {
        $answerData->ansmarathi = $option; // Save Marathi option in 'ansmarathi' column
    } elseif ($languageColumn === 'quehindi') {
        $answerData->anshindi = $option; // Save Hindi option in 'anshindi' column
    } else {
        $answerData->ans = $option; // Save English option in 'ans' column
    }

    $answerData->save();
    
    // Save the $answerData id in the wright_ans column of Practisemcq
    $questionData->wright_ans = $answerData->id;
    $questionData->save();
}

        }

        fclose($handle);

        return redirect()->route('practicemcq.index')->with('status', 'Questions Created Successfully');
    }
}

return back()->withErrors(['file' => 'Invalid CSV file. Please upload a valid file.']);
}



    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Practisemcq  $practisemcq
     * @return \Illuminate\Http\Response
     */
    public function show(Practisemcq $practisemcq)
    {
        return view('practicemcq.show',compact('practisemcq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Practisemcq  $practisemcq
     * @return \Illuminate\Http\Response
     */
    public function edit(Practisemcq $practisemcq)
    {
        $wright_ansData = McqAnswer::where(['practisemcq_id' => $practisemcq->id])->get()->pluck('id');
    
        if (auth()->user()->userType == 2) {
            foreach (auth()->user()->institute->institutecourse as $key => $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id', $course_arr)->get();
        } else if (auth()->user()->userType == 3) {
            foreach (auth()->user()->instructor->institute->institutecourse as $key => $course_value) {
                $course_arr[] = $course_value->course->id;
            }
            $subjectData = Subject::whereIn('course_id', $course_arr)->get();
        }
    
        $mcqtypeData = Mcqtype::all();
    
        return view('practicemcq.edit', compact('practisemcq', 'subjectData', 'mcqtypeData'));
    }



    public function update(Request $request, Practisemcq $practisemcq)
{
    $filePath = 'path/to/your/csv/file.csv';

    // Read the CSV file
    $file = fopen(public_path('csv/questions.csv'), 'r');



    // Skip the header row
    fgetcsv($file);

    while (($data = fgetcsv($file)) !== false) {
        $subjectId = $data[0];
        $mcqType = $data[1];

        // Update the respective column based on subject_id and mcq_type
        if ($subjectId == 1 && $mcqType == '30wpm') {
            $column = 'que';
            $value = 'English subject (30wpm)';
        } elseif ($subjectId == 2 && $mcqType == '40wpm') {
            $column = 'que';
            $value = 'English subject (40wpm)';
        } elseif ($subjectId == 3 && $mcqType == '30wpm') {
            $column = 'quemarathi';
            $value = 'Marathi 30wpm';
        } elseif ($subjectId == 4 && $mcqType == '40wpm') {
            $column = 'quemarathi';
            $value = 'Marathi 40wpm';
        } elseif ($subjectId == 5 && $mcqType == '30wpm') {
            $column = 'quehindi';
            $value = 'Hindi 30wpm';
        } elseif ($subjectId == 6 && $mcqType == '40wpm') {
            $column = 'quehindi';
            $value = 'Hindi 40wpm';
        }

        // Update the respective column in the database
        DB::table('practisemcqs')
            ->where('subject_id', $subjectId)
            ->update([$column => $value]);
    }

    fclose($file);

    return redirect()->route('practicemcq.index')->with('status', 'CSV data updated successfully');
}


    


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Practisemcq  $practisemcq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Practisemcq $practisemcq)
    {
//        dd($practisemcq);
        $practisemcq->delete();

        return back()->with('status','Question Deleted Successfully.');
    }
}