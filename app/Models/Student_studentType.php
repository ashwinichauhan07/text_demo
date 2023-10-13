<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_studentType extends Model
{
    use HasFactory;
     protected $fillable = [
        'institute_id', 
        'student_id', 
        'studenttype_id', 
    ];

     public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function studentType()
    {
      return $this->belongsTo(StudentType::class,'studenttype_id');
    }
}
