<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBatchAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'exambatches_id',
        'batch_name',
        'subject_id',
        'exam_name',
    ];

	public function student()
    {
    	return $this->hasMany(ExamStudent::class);
    }

    public function mcqstudent()
    {
    	return $this->hasMany(Mcqexamstudent::class);
    }

    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }

    public function exam_batches()
    {
    	return $this->belongsTo(ExamBatches::class,'exambatches_id');
    }

    public function examname()
    {
    	return $this->belongsTo(ExamName::class,'exam_name');
    }
}
