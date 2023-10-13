<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSubject extends Model
{
    use HasFactory;
    use SoftDeletes;

     protected $fillable = [
    	
        'student_id',
        'student_type',
    	'subject_id',
        'subject_grno',
        'institute_id',
        'old',
        'doaddmission',
        'isession_id',
        'year'
    	
    ];

     public function student()
    {
        return $this->belongsTo(Student::class);
    }

     public function student_repeat()
    {
        return $this->belongsTo(Student_Repeat::class);
    }

     public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function studentType()
    {
      return $this->belongsTo(StudentType::class,'student_type');
    }
    
}


