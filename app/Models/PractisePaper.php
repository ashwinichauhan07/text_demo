<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractisePaper extends Model
{
    use HasFactory;

    protected $fillable = [
        'mcq_type_id',
        'student_id',
        'question_id',
        'answer_id',
        'ans',
    ];

    public function exam()
    {
        return $this->belongsTo(PractiseExam::class);
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
