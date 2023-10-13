<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'institute_id',
        'user_id',
        'question_bank_no',
        'batch_name',
        'exam_name',
        'subject_id',
        'instruction',
        'startExam',
        'endExam',
        'duration',
        'instruction_time',
        'pass_percentage',
        'result'
    ];

	public function student()
    {
    	return $this->hasMany(Mcqexamstudent::class);
    }

    public function institute()
    {
        return $this->belongsTo(User::class,'institute_id','id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }


    public function question_bank()
    {
        return $this->hasOne(QuestionBank::class,'id','question_bank_no');
    }

    public function paper()
    {
        return $this->hasMany(Paper::class);
    }

    public function exam_batche()
    {
        return $this->belongsTo(ExamBatches::class,'batch_name');
    }

    public function examname()
    {
        return $this->belongsTo(ExamName::class,'exam_name');
    }


}
