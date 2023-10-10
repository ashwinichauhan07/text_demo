<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCQPractiseExam extends Model
{


      protected $fillable = [
        'institute_id',
        'user_id',
        'question_bank_no',
        'name',
        'code',
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
    	return $this->hasMany(TestStudent::class);
    }

    public function institute()
    {
        return $this->belongsTo(User::class,'institute_id','id');
    }


    public function question_bank()
    {
        return $this->hasOne(PractiseMCQTest::class,'id','question_bank_no');
    }

    public function paper()
    {
        return $this->hasMany(TestPaper::class);
    }
}
