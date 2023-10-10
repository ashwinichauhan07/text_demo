<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student_course extends Model
{
    use HasFactory;
    use SoftDeletes;
     protected $fillable = [
    	
         'student_id',
    	 'course_id',
         'student_type',
         'old',
         'doaddmission',
         'isession_id',
         'year'
    	
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
}
