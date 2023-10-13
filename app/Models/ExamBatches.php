<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExamBatches extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
    	'institute_id',
    	'exam_date',
        'exam_name',
         'day',
    	'start_time',
    	'end_time',
        'batch_number',
        'subject_id',

    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function eammname()
    {
        return $this->belongsTo(ExamName::class,'exam_name');
    }



}
