<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursefee extends Model
{
    use HasFactory;

     protected $fillable = [
    	'course_id','subject_id','student_type', 'fees', 'institute_id'
    ];

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }
     public function student()
    {
        return $this->hanMany(Student::class);
    }
    public function studenttype()
    {
        return $this->belongsTo(StudentType::class,'student_type');
    }



}
