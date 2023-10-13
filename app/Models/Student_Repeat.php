<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_Repeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'student_id',
        'doaddmission',
        'student_type',
        'course_id',
        'subject_id',
        'itiming_id',
        'coursefee_id',
        'isession_id',
        'year'
        ];

     public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function student_subject()
    {
        return $this->hasMany(StudentSubject::class);
    }
}
