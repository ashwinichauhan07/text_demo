<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPaper extends Model
{
    use HasFactory;

      protected $fillable = [
        'm_c_q_practise_exam_id',
        'student_id',
        'question_id',
        'answer_id',
        'ans',
    ];

    public function exam()
    {
        return $this->belongsTo(MCQPractiseExam::class,'m_c_q_practise_exam_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function question()
    {
        return $this->belongsTo(Practisemcq::class);
    }

    public function answer()
    {
        return $this->belongsTo(McqAnswer::class);
    }
}
