<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TypingExam extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'institute_id',
        'batch_name',
        'exam_name',
        'subject_id',
        'practise_type',
        'exam_time',
        'exam_mark',
        'typingdata',
        'key'
    ];


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function practise()
    {
        return $this->belongsTo(PractiseType::class,'practise_type');
    }

    public function batchname()
    {
        return $this->belongsTo(ExamBatches::class,'batch_name');
    }

    public function examname()
    {
        return $this->belongsTo(ExamName::class,'exam_name');
    }

}
